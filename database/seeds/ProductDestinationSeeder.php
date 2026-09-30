<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDestinationSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $regions = [
            'north-vietnam' => [
                'name' => 'North Vietnam',
                'types' => ['Hanoi', 'Sapa', 'Halong Bay', 'Mai Chau', 'Ninh Binh', 'Moc Chau'],
            ],
            'central-vietnam' => [
                'name' => 'Central Vietnam',
                'types' => ['Hoi An', 'Hue', 'DMZ', 'Da Nang', 'Nha Trang', 'Phong Nha – Ke Bang'],
            ],
            'south-vietnam' => [
                'name' => 'South Vietnam',
                'types' => ['Ho Chi Minh City', 'Ben Tre', 'Con Dao Island', 'My Tho', 'Can Tho', 'Chau Doc'],
            ],
            'south-east-asia' => [
                'name' => 'South East Asia',
                'types' => ['Cambodia', 'Laos', 'Myanmar', 'Thailand'],
            ],
        ];

        foreach ($regions as $slug => $region) {
            $name = $this->langName($region['name']);
            $category = DB::table('product_category')->where('slug', $slug)->first();

            if ($category) {
                DB::table('product_category')->where('id', $category->id)->update([
                    'name' => $name,
                    'status' => 1,
                    'updated_at' => $now,
                ]);
                $categoryId = $category->id;
            } else {
                $categoryId = DB::table('product_category')->insertGetId([
                    'quiz_id' => 0,
                    'language' => '0',
                    'name' => $name,
                    'slug' => $slug,
                    'status' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            foreach ($region['types'] as $typeName) {
                $typeSlug = to_slug($typeName);
                $type = DB::table('product_type')->where('slug', $typeSlug)->first();
                $payload = [
                    'name' => $this->langName($typeName),
                    'cate_id' => $categoryId,
                    'cate_slug' => $slug,
                    'status' => 1,
                    'updated_at' => $now,
                ];

                if ($type) {
                    DB::table('product_type')->where('id', $type->id)->update($payload);
                    continue;
                }

                DB::table('product_type')->insert($payload + [
                    'quiz_id' => 0,
                    'language' => '0',
                    'slug' => $typeSlug,
                    'created_at' => $now,
                ]);
            }
        }
    }

    private function langName($label)
    {
        return json_encode([
            ['lang_code' => 'vi', 'content' => $label],
            ['lang_code' => 'en-US', 'content' => $label],
        ], JSON_UNESCAPED_UNICODE);
    }
}
