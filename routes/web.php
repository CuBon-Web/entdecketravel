<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/sitemap.xml', 'SeoController@sitemap')->name('sitemap');
Route::get('/robots.txt', 'SeoController@robots')->name('robots');
Route::get('/crm', function () {
    return view('app');
});
Route::get('/languages/{lang}', 'LanguageController@index')->name('languages');
Route::get('/','HomeController@home')->name('home')->middleware(checkLanguage::class);
Route::group(['namespace'=>'Client','middleware' => ['checkLanguage']], function(){
    Route::get('get-variant.html','ProductController@getSku')->name('getSku');
    Route::get('type-product/{id}','PageController@typeproduct');
    Route::get('district/{id}','PageController@district');
    
    Route::get('dang-nhap.html','AuthController@login')->name('login')->middleware('CheckAuthLogout::class');
    Route::post('dang-nhap.html','AuthController@postLogin')->name('postlogin');
    Route::get('dang-ky.html','AuthController@register')->name('register');
    Route::post('dang-ky.html','AuthController@postRegister')->name('postRegister');
    Route::get('dang-xuat.html','AuthController@logout')->name('logout')->middleware('CheckAuthClient::class');
    Route::post('filter.html','ProductController@filterProduct')->name('filterProduct');
    Route::get('build-pc.html','BuildPcController@buildPc')->name('buildPc');
    
    Route::get('video-review.html','PageController@videoReview')->name('videoReview');
    Route::get('page-content/{slug}.html','PageContentController@detail')->name('pagecontent');
    Route::get('service/{slug}.html','PageController@serviceList')->name('serviceList');
    Route::get('service/{danhmuc}/{slug}.html','PageController@serviceDetail')->name('serviceDetail');
    Route::get('about.html','PageController@aboutUs')->name('aboutUs');  
    Route::get('cong-nghe.html','PageController@technology')->name('technology');   
    Route::get('contact.html','PageController@contact')->name('lienHe');
    Route::get('contact-captcha.png','PageController@contactCaptcha')->name('contactCaptcha');
    Route::post('lien-he','PageController@postcontact')->name('postcontact');
    Route::get('gallery.html','PageController@gallery')->name('gallery');
    Route::get('fags.html','PageController@fags')->name('fags');
    Route::get('feedback.html','PageController@feedback')->name('feedback');
    Route::get('book-a-trip.html','PageController@bookATrrip')->name('bookATrrip');
    Route::get('giai-phap/{slug}.html','SolutionController@detail')->name('detailSolution');

    Route::group(['prefix'=>'cong-trinh'], function(){
        Route::get('/tat-ca.html','ConstructionController@list')->name('allListConstruction');
        Route::get('{id}.html','ConstructionController@detail')->name('detailConstruction');
    });
    Route::post('quickview','PageController@quickview')->name('quickview');
    Route::get('nhan-bao-gia.html','PageController@baogia')->name('baogia');

    Route::get('gio-hang.html', 'CartController@listCart')->name('listCart');
    Route::post('add-to-cart', 'CartController@addToCart')->name('add.to.cart');
    Route::post('add-wishtlist', 'ProductController@addWishList')->name('addWishList');
    Route::post('remove-wishtlist', 'ProductController@removeWishList')->name('removeWishList');
    Route::get('wishlist.html','ProductController@listWishList')->name('wishlist');
    // Route::post('update-cart', 'CartController@update')->name('update.cart');
    Route::post('remove-from-cart', 'CartController@remove')->name('remove.from.cart');
    Route::get('thanh-toan.html','CartController@checkout')->name('checkout');
    Route::post('thantoan','CartController@postBill')->name('postBill');
    Route::get('dat-hang-thanh-cong.html','CartController@orderSuccess')->name('orderSuccess');

    Route::get('dat-ban.html','PageController@orderNow')->name('orderNow');
    Route::get('menu.html','PageController@menu')->name('menu');
    Route::get('account/orders','AuthController@accoungOrder')->name('accoungOrder')->middleware('CheckAuthClient::class');
    Route::get('account/orders/{billid}','AuthController@accoungOrderDetail')->name('accoungOrderDetail')->middleware('CheckAuthClient::class');
    
    Route::post('buildpc','BuildPcController@renderProductBuild')->name('renderProductBuild');
    Route::post('addProductBuildPc','BuildPcController@addProductBuildPc')->name('addProductBuildPc');
    Route::post('removeItemBuild','BuildPcController@removeItemBuild')->name('removeItemBuild');
    Route::post('plusQtyItemBuild','BuildPcController@plusQtyItemBuild')->name('plusQtyItemBuild');
    Route::post('mineQtyItemBuild','BuildPcController@mineQtyItemBuild')->name('mineQtyItemBuild');
    Route::post('addBuildToCart','BuildPcController@addBuildToCart')->name('addBuildToCart');
    
    Route::get('auth/google', 'GoogleController@redirectToGoogle')->name('loginGoogle');
    Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');

    Route::get('auth/facebook', 'FacebookController@redirectToFacebook')->name('loginFacebook');
    Route::get('auth/facebook/callback', 'FacebookController@handleFacebookCallback'); 
    Route::group(['prefix'=>'news'], function(){
        Route::get('/all.html','BlogController@list')->name('allListBlog');
        Route::get('category/{slug}.html','BlogController@listCateBlog')->name('listCateBlog');
        Route::get('type-category/{slug}.html','BlogController@listTypeBlog')->name('listTypeBlog');
        Route::get('detail/{slug}.html','BlogController@detailBlog')->name('detailBlog');
    });

    Route::get('search', 'SearchController@index')->name('globalSearch');

    Route::get('all-tour.html','ProductController@allProduct')->name('allProduct');
    Route::get('book-tour','ProductController@bookTour')->name('bookTour');
    Route::post('book-tour','ProductController@postBookTour')->name('postBookTour');
    Route::get('destination.html','ProductController@Destination')->name('destination');
    Route::get('san-pham-noi-bat.html','ProductController@flashSale')->name('flashSale');
    Route::get('tag/{tag}.html','ProductController@tag')->name('allListTags');
    Route::get('tour-detail/{cate}/{type}/{id}.html','ProductController@detail_product')->name('detailProduct');
    Route::get('{danhmuc}.html','ProductController@allListCate')->name('allListProCate');
    Route::get('{danhmuc}/{loaidanhmuc}.html','ProductController@allListType')->name('allListType');
    Route::get('{danhmuc}/{loaidanhmuc}/{loai2}.html','ProductController@allListTypeTwo')->name('allListTypeTwo');
    Route::post('san-pham/compare','ProductController@compare')->name('compareProduct');
    Route::post('san-pham/remove-compare','ProductController@removeCompare')->name('removeCompare');
    Route::get('san-pham/so-sanh-san-pham','ProductController@compareList')->name('compareList');
    Route::post('auto-search-product','ProductController@autosearchcomplete')->name('autosearchcomplete');
    Route::post('result-search','ProductController@searchResult')->name('search_result');
    Route::post('search-tour','ProductController@searchTour')->name('searchTour');
    Route::post('search-service','ProductController@searchService')->name('searchService');
});



