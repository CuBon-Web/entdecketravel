@extends('layouts.main.master')
@section('title')
{{$product->name}}
@endsection
@section('description')
{{languageName($product->description)}}
@endsection
@section('image')
@php
$img = json_decode($product->images);
$route = json_decode($product->size);
$datetour = json_decode($product->preserve);
$ingredient = json_decode($product->ingredient);
//  dd(json_decode($product->content));
@endphp
{{url(''.$img[0])}}
@endsection
@section('schema')
<script type="application/ld+json">
{!! json_encode([
   '@context' => 'https://schema.org',
   '@type' => 'TouristTrip',
   'name' => $product->name,
   'description' => strip_tags(languageName($product->description)),
   'image' => [url('' . $img[0])],
   'url' => url()->current(),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
   '@context' => 'https://schema.org',
   '@type' => 'BreadcrumbList',
   'itemListElement' => [
      [
         '@type' => 'ListItem',
         'position' => 1,
         'name' => 'Home',
         'item' => url('/'),
      ],
      [
         '@type' => 'ListItem',
         'position' => 2,
         'name' => 'Tour',
         'item' => url('/'),
      ],
      [
         '@type' => 'ListItem',
         'position' => 3,
         'name' => $product->name,
         'item' => url()->current(),
      ],
   ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection
@section('css')
<style>
.tour-price-box {
    background: #fff;
    border: 1px solid #e4eee6;
    border-radius: 16px;
    padding: 28px 28px 22px;
    margin: 8px 0 36px;
    box-shadow: 0 8px 24px rgba(52, 96, 101, 0.06);
}
.tour-price-lead {
    color: #346065;
    text-align: center;
    font-size: 15px;
    line-height: 1.65;
    margin: 0 auto 26px;
    max-width: 640px;
}
.price-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px 32px;
    margin: 0 0 28px;
}
.price-split h4 {
    color: #1e3a8a;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.price-split ul {
    margin: 0;
    padding-left: 18px;
}
.price-split li {
    margin-bottom: 8px;
    color: #3f4b50;
    line-height: 1.5;
}
.price-split-excludes {
    border-left: 1px solid #e5e7eb;
    padding-left: 28px;
}
@media (max-width: 767px) {
    .price-split {
        grid-template-columns: 1fr;
    }
    .price-split-excludes {
        border-left: 0;
        padding-left: 0;
        border-top: 1px solid #e5e7eb;
        padding-top: 18px;
    }
}
.tour-price-row {
    display: grid;
    grid-template-columns: 190px minmax(0, 1fr);
    gap: 12px 20px;
    align-items: center;
    margin-bottom: 14px;
}
.tour-price-label {
    color: #346065;
    font-weight: 600;
    font-size: 15px;
    margin: 0;
}
.tour-price-radios {
    display: flex;
    flex-wrap: wrap;
    gap: 8px 22px;
    min-height: 48px;
    align-items: center;
}
.tour-price-radios label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    color: #346065;
    font-weight: 500;
    cursor: pointer;
}
.tour-price-radios input {
    accent-color: #85D200;
    width: 16px;
    height: 16px;
    margin: 0;
}
.tour-price-field {
    display: flex;
    align-items: center;
    min-height: 48px;
    border: 1px solid #d5e0dc;
    border-radius: 10px;
    background: #fff;
    padding: 0 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.tour-price-field:focus-within {
    border-color: #85D200;
    box-shadow: 0 0 0 3px rgba(133, 210, 0, 0.18);
}
.tour-price-field > i {
    color: #8aa0a4;
    margin-right: 10px;
    font-size: 16px;
    flex: 0 0 auto;
}
.tour-price-field input,
.tour-price-field select {
    border: 0;
    outline: 0;
    width: 100%;
    height: 46px;
    background: transparent;
    color: #346065;
    font-size: 14px;
    font-family: "Figtree", sans-serif;
    box-shadow: none;
}
.tour-price-field select {
    cursor: pointer;
    appearance: none;
    background-color: transparent;
    background-image: linear-gradient(45deg, transparent 50%, #346065 50%), linear-gradient(135deg, #346065 50%, transparent 50%);
    background-position: calc(100% - 14px) 20px, calc(100% - 8px) 20px;
    background-size: 6px 6px, 6px 6px;
    background-repeat: no-repeat;
    padding-right: 28px;
}
.tour-price-date {
    position: relative;
}
.tour-price-date-hint {
    position: absolute;
    left: 40px;
    color: #8aa0a4;
    pointer-events: none;
    font-size: 14px;
}
.tour-price-date input[type="date"]::-webkit-calendar-picker-indicator {
    opacity: 0;
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}
#tour-price-date-row.has-value .tour-price-date-hint,
.tour-price-date:focus-within .tour-price-date-hint {
    display: none;
}
#tour-price-date-row:not(.has-value) .tour-price-date:not(:focus-within) input[type="date"]::-webkit-datetime-edit {
    color: transparent;
}
.tour-price-row-follow .tour-price-field {
    grid-column: 2;
}
.tour-price-phone {
    position: relative;
    display: flex;
    align-items: stretch;
    min-height: 48px;
    border: 1px solid #d5e0dc;
    border-radius: 10px;
    background: #fff;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.tour-price-phone:focus-within {
    border-color: #85D200;
    box-shadow: 0 0 0 3px rgba(133, 210, 0, 0.18);
}
.tour-price-dial-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 0 0 auto;
    height: 46px;
    margin: 0;
    padding: 0 12px;
    border: 0;
    border-right: 1px solid #d5e0dc;
    background: #f4f7f5;
    color: #346065;
    font-weight: 600;
    font-size: 14px;
    font-family: "Figtree", sans-serif;
    cursor: pointer;
}
.tour-price-dial-btn i {
    font-size: 12px;
    color: #6d7c80;
}
.tour-price-flag-img {
    width: 20px;
    height: 15px;
    object-fit: cover;
    border-radius: 2px;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.12);
}
.tour-price-phone input[type="tel"] {
    border: 0;
    outline: 0;
    flex: 1;
    min-width: 0;
    height: 46px;
    padding: 0 14px;
    background: transparent;
    color: #346065;
    font-size: 14px;
    font-family: "Figtree", sans-serif;
}
.tour-price-dial-menu {
    position: absolute;
    z-index: 40;
    top: calc(100% + 6px);
    left: 0;
    width: 100%;
    margin: 0;
    padding: 0;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 10px 28px rgba(15, 23, 42, 0.14);
    overflow: hidden;
}
.tour-price-dial-menu:not([hidden]) {
    display: flex;
    flex-direction: column;
}
.tour-price-dial-search {
    padding: 8px;
    border-bottom: 1px solid #e5e7eb;
}
.tour-price-dial-search input {
    width: 100%;
    height: 38px;
    border: 1px solid #d5e0dc;
    border-radius: 8px;
    padding: 0 12px;
    color: #346065;
    font-size: 14px;
    font-family: "Figtree", sans-serif;
    outline: none;
    background: #fff;
}
.tour-price-dial-search input:focus {
    border-color: #85D200;
    box-shadow: 0 0 0 3px rgba(133, 210, 0, 0.18);
}
.tour-price-dial-list {
    max-height: 240px;
    overflow: auto;
    padding: 6px 0;
}
.tour-price-dial-empty {
    display: none;
    padding: 12px 14px;
    color: #8b949e;
    font-size: 14px;
}
.tour-price-dial-empty.is-visible {
    display: block;
}
.tour-price-dial-item {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    border: 0;
    background: #fff;
    color: #3f4b50;
    font-size: 14px;
    font-family: "Figtree", sans-serif;
    text-align: left;
    padding: 8px 14px;
    cursor: pointer;
}
.tour-price-dial-item:hover,
.tour-price-dial-item.is-active {
    background: #f3f4f6;
}
.tour-price-dial-code {
    color: #8b949e;
    white-space: nowrap;
}
.tour-price-captcha {
    grid-column: 2;
}
.tour-price-box .simple-captcha-image {
    border-color: #85D200;
}
.tour-price-box .form-control {
    height: 46px;
    border: 1px solid #d5e0dc;
    border-radius: 10px;
    background: #fff;
    color: #346065;
}
.tour-price-box .form-control:focus {
    border-color: #85D200;
    box-shadow: 0 0 0 3px rgba(133, 210, 0, 0.18);
    background: #fff;
}
.tour-price-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 6px;
}
.tour-price-actions .site-button {
    min-height: 44px;
    padding: 10px 28px;
    letter-spacing: 0.04em;
}
.booking-enquiry .form-label {
    display: block;
    margin-bottom: 6px;
    color: #346065;
    font-weight: 600;
    font-size: 14px;
}
.booking-enquiry .form-group {
    margin-bottom: 14px;
}
.booking-enquiry .form-control {
    min-height: 46px;
    border: 1px solid #d5e0dc;
    border-radius: 10px;
    color: #346065;
}
.booking-enquiry .form-control:focus {
    border-color: #85D200;
    box-shadow: 0 0 0 3px rgba(133, 210, 0, 0.18);
}
.booking-enquiry textarea.form-control {
    min-height: 110px;
}
.booking-enquiry .booking-phone-note {
    margin: 6px 0 0;
    color: #6d7c80;
    font-size: 12px;
    line-height: 1.4;
}
.booking-enquiry .site-button {
    width: 100%;
    margin-top: 4px;
}
@media (max-width: 767px) {
    .tour-price-box {
        padding: 20px 16px 16px;
    }
    .tour-price-row {
        grid-template-columns: 1fr;
    }
    .tour-price-row-follow .tour-price-field {
        grid-column: 1;
    }
}
.side-bar .trv-tour-single-r-detail {
    padding: 16px 20px 18px;
}
.side-bar .trv-tour-single-r-detail .trv-star-from {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #9a7a2a;
    margin-bottom: 6px;
}
.side-bar .trv-tour-single-r-detail .trv-star-amount {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 4px 10px;
    font-size: 22px;
    line-height: 1.2;
    font-weight: 700;
}
.side-bar .trv-tour-single-r-detail .trv-star-amount s {
    font-size: 14px;
    font-weight: 500;
    color: #9aa3a6;
    text-decoration: line-through;
}
.itinerary-html p {
    margin: 0 0 8px;
}
.itinerary-html ul,
.itinerary-html ol {
    margin: 0 0 8px;
    padding-left: 18px;
}
.side-bar .trv-tour-single-r-detail .trv-star-now {
    font-size: 22px;
    font-weight: 700;
    color: #e39405;
    letter-spacing: -0.02em;
}
</style>
@endsection
@section('js')
<script>
function initDialPhones() {
    var nodes = document.querySelectorAll('.js-dial-phone');
    var dataNode = document.getElementById('tour-dial-codes');
    if (!nodes.length || !dataNode) return;
    var dialData = [];
    try {
        dialData = JSON.parse(dataNode.textContent || '[]');
    } catch (err) {
        dialData = [];
    }
    var widgets = [];

    function flagSrc(iso) {
        return 'https://flagcdn.com/w40/' + String(iso || '').toLowerCase() + '.png';
    }
    function dialSearchText(value) {
        return String(value || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }

    Array.prototype.forEach.call(nodes, function (root) {
        var dialBtn = root.querySelector('[data-dial-btn]');
        var dialMenu = root.querySelector('[data-dial-menu]');
        var dialLabel = root.querySelector('[data-dial-label]');
        var flagEl = root.querySelector('[data-dial-flag]');
        var dialCodeInput = root.querySelector('[data-dial-code]');
        var countryInput = root.querySelector('[data-dial-country]');
        var isoInput = root.querySelector('[data-dial-iso]');
        var searchInput = null;
        var ready = false;
        if (!dialBtn || !dialMenu) return;

        function selectDial(country, item) {
            if (!country) return;
            if (dialCodeInput) dialCodeInput.value = country.dial;
            if (countryInput) countryInput.value = country.name;
            if (isoInput) isoInput.value = country.iso;
            if (dialLabel) dialLabel.textContent = country.dial;
            if (flagEl) flagEl.src = flagSrc(country.iso);
            dialBtn.setAttribute('aria-label', 'Country code ' + country.label);
            Array.prototype.forEach.call(dialMenu.querySelectorAll('.tour-price-dial-item'), function (el) {
                el.classList.remove('is-active');
            });
            if (item) item.classList.add('is-active');
        }
        function filterDialMenu(query) {
            var q = dialSearchText(query).trim();
            var shown = 0;
            Array.prototype.forEach.call(dialMenu.querySelectorAll('.tour-price-dial-item'), function (item) {
                var haystack = item.getAttribute('data-search') || '';
                var match = q === '' || haystack.indexOf(q) !== -1;
                item.hidden = !match;
                if (match) shown += 1;
            });
            var empty = dialMenu.querySelector('.tour-price-dial-empty');
            if (empty) empty.classList.toggle('is-visible', shown === 0);
        }
        function buildDialMenu() {
            if (ready) return;
            ready = true;
            var searchWrap = document.createElement('div');
            searchWrap.className = 'tour-price-dial-search';
            searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.placeholder = 'Search country or code';
            searchInput.setAttribute('aria-label', 'Search country or code');
            searchInput.autocomplete = 'off';
            searchInput.addEventListener('input', function () {
                filterDialMenu(searchInput.value);
            });
            searchInput.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') event.preventDefault();
            });
            searchWrap.appendChild(searchInput);
            var list = document.createElement('div');
            list.className = 'tour-price-dial-list';
            var currentIso = isoInput ? isoInput.value : 'VN';
            dialData.forEach(function (country) {
                var item = document.createElement('button');
                item.type = 'button';
                item.className = 'tour-price-dial-item' + (country.iso === currentIso ? ' is-active' : '');
                item.setAttribute('role', 'option');
                item.setAttribute('data-search', dialSearchText([country.label, country.name, country.iso, country.dial, String(country.dial || '').replace('+', '')].join(' ')));
                item.innerHTML = '<img class="tour-price-flag-img" alt="" src="' + flagSrc(country.iso) + '"><span class="tour-price-dial-name"></span><span class="tour-price-dial-code"></span>';
                item.querySelector('.tour-price-dial-name').textContent = country.label;
                item.querySelector('.tour-price-dial-code').textContent = country.dial;
                item.addEventListener('click', function () {
                    selectDial(country, item);
                    closeDialMenu();
                });
                list.appendChild(item);
            });
            var empty = document.createElement('div');
            empty.className = 'tour-price-dial-empty';
            empty.textContent = 'No matching country';
            dialMenu.appendChild(searchWrap);
            dialMenu.appendChild(list);
            dialMenu.appendChild(empty);
        }
        function openDialMenu() {
            buildDialMenu();
            if (searchInput) {
                searchInput.value = '';
                filterDialMenu('');
            }
            dialMenu.hidden = false;
            dialBtn.setAttribute('aria-expanded', 'true');
            var active = dialMenu.querySelector('.tour-price-dial-item.is-active');
            if (active && active.scrollIntoView) active.scrollIntoView({ block: 'nearest' });
            if (searchInput) searchInput.focus();
        }
        function closeDialMenu() {
            dialMenu.hidden = true;
            dialBtn.setAttribute('aria-expanded', 'false');
        }
        dialBtn.addEventListener('click', function () {
            if (dialMenu.hidden) openDialMenu();
            else closeDialMenu();
        });
        widgets.push({ root: root, menu: dialMenu, close: closeDialMenu });
    });

    document.addEventListener('click', function (event) {
        widgets.forEach(function (widget) {
            if (widget.menu.hidden) return;
            if (widget.root.contains(event.target)) return;
            widget.close();
        });
    });
    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') return;
        widgets.forEach(function (widget) { widget.close(); });
    });
}
function refreshTourPriceCaptcha() {
    var img = document.getElementById('tour-price-captcha-img');
    if (img) {
        img.src = '{{ route('contactCaptcha', ['scope' => 'quote']) }}&t=' + Date.now();
    }
}
document.addEventListener('DOMContentLoaded', function () {
    initDialPhones();
    var nav = document.querySelector('.navbar-one');
    if (!nav) return;
    var links = Array.prototype.slice.call(nav.querySelectorAll('a[href^="#"]'));
    var sections = links
        .map(function (a) { var el = document.querySelector(a.getAttribute('href')); return el ? { id: a.getAttribute('href'), el: el } : null; })
        .filter(Boolean);

    function setActive(href) {
        links.forEach(function (a) {
            if (a.getAttribute('href') === href) {
                a.classList.add('active');
            } else {
                a.classList.remove('active');
            }
        });
    }

    // Click smooth scroll + active state
    links.forEach(function (a) {
        a.addEventListener('click', function (e) {
            var targetId = a.getAttribute('href');
            var target = document.querySelector(targetId);
            if (!target) return;
            e.preventDefault();
            var top = target.getBoundingClientRect().top + window.pageYOffset - 100; // offset for sticky header
            window.scrollTo({ top: top, behavior: 'smooth' });
            setActive(targetId);
        });
    });

    // Observe sections for active on scroll
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActive('#' + entry.target.id);
                }
            });
        }, { root: null, rootMargin: '-40% 0px -50% 0px', threshold: [0, 0.2, 0.5, 1] });

        sections.forEach(function (s) { observer.observe(s.el); });
    } else {
        // Fallback: throttle scroll
        var onScroll = function () {
            var scrollPos = window.pageYOffset + 120;
            var current = sections[0] ? sections[0].id : null;
            sections.forEach(function (s) {
                var top = s.el.offsetTop;
                if (scrollPos >= top) current = '#' + s.el.id;
            });
            if (current) setActive(current);
        };
        document.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    var quoteForm = document.getElementById('tour-price-form');
    if (quoteForm) {
        var specificDate = quoteForm.querySelector('input[name="date_type"][value="specific"]');
        var flexibleDate = quoteForm.querySelector('input[name="date_type"][value="flexible"]');
        var dateRow = document.getElementById('tour-price-date-row');
        var dateInput = quoteForm.querySelector('input[name="travel_date"]');

        function syncTravelDate() {
            var isSpecific = specificDate && specificDate.checked;
            if (dateRow) dateRow.style.display = isSpecific ? '' : 'none';
            if (dateInput) dateInput.required = !!isSpecific;
        }
        function syncDateHint() {
            if (!dateRow || !dateInput) return;
            dateRow.classList.toggle('has-value', !!dateInput.value);
        }
        if (specificDate) specificDate.addEventListener('change', syncTravelDate);
        if (flexibleDate) flexibleDate.addEventListener('change', syncTravelDate);
        if (dateInput) {
            dateInput.addEventListener('change', syncDateHint);
            dateInput.addEventListener('input', syncDateHint);
        }
        syncTravelDate();
        syncDateHint();

        quoteForm.addEventListener('submit', function (e) {
            var email = (quoteForm.querySelector('input[name="email"]').value || '').trim();
            var confirmEmail = (quoteForm.querySelector('input[name="email_confirm"]').value || '').trim();
            var alertBox = document.getElementById('tour-price-client-error');
            if (email !== confirmEmail) {
                e.preventDefault();
                if (alertBox) {
                    alertBox.textContent = 'Email addresses do not match.';
                    alertBox.style.display = 'block';
                }
            } else if (alertBox) {
                alertBox.style.display = 'none';
            }
        });

        if (document.querySelector('.tour-price-alert')) {
            setActive('#tourprice');
            var quoteSection = document.getElementById('tourprice');
            if (quoteSection) {
                var quoteTop = quoteSection.getBoundingClientRect().top + window.pageYOffset - 100;
                window.scrollTo({ top: quoteTop, behavior: 'smooth' });
            }
        }
    }

    var bookingForm = document.getElementById('booking-enquiry-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function (e) {
            var email = (bookingForm.querySelector('input[name="email"]').value || '').trim();
            var confirmEmail = (bookingForm.querySelector('input[name="email_confirm"]').value || '').trim();
            var alertBox = document.getElementById('booking-client-error');
            if (email !== confirmEmail) {
                e.preventDefault();
                if (alertBox) {
                    alertBox.textContent = 'Email addresses do not match.';
                    alertBox.style.display = 'block';
                }
            } else if (alertBox) {
                alertBox.style.display = 'none';
            }
        });
    }
    if (document.querySelector('.booking-enquiry-alert')) {
        var bookingBox = document.getElementById('booking-enquiry-form');
        if (bookingBox) {
            var bookingTop = bookingBox.getBoundingClientRect().top + window.pageYOffset - 100;
            window.scrollTo({ top: bookingTop, behavior: 'smooth' });
        }
    }
});
</script>
@endsection
@section('content')
<div class="page-content">

   <!-- INNER PAGE BANNER -->
   <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image: url({{$img[0] ?? url('frontend/images/inr-banner.jpg')}});">
       <div class="overlay-main innr-bnr-olay"></div>
       <div class="wt-bnr-inr-entry">
           <div class="banner-title-outer">
               <div class="banner-title-name">
                   <h2 class="wt-title">{{languageName($product->name)}}</h2>
               </div>
               <!-- BREADCRUMB ROW -->                            
               <div>
                   <ul class="wt-breadcrumb breadcrumb-style-2">
                       <li><a href="{{ route('home') }}">Home</a></li>
                       <li>{{languageName($product->name)}}</li>
                   </ul>
               </div>
           </div>
           <!-- BREADCRUMB ROW END -->                        
       </div>
   </div>
   <!-- INNER PAGE BANNER END -->

   <!-- SECTION START -->
   <div class="section-full  p-t120 p-b90">
       <div class="container">
       
           <!-- SECTION START -->
           <div class="section-content">
               <div class="row d-flex justify-content-center">

                   <div class="col-xl-8 col-lg-8 col-md-12 m-b30">
                       <div class="trv-detail-main-wrap">
                           
                           <!--Info Start-->
                           <div class="trv-detail-bx-wrap">

                               <div class="trv-inr-para2">
                                   <h1 class="trv-inner-title-lg">{{$product->name}}</h1>
                                   

                                 <div class="section-full trv-gallery-wrap">
                                    <div class="section-content">
                        
                                       <div class="trv-gallery-section row">
                   
                                           <!-- COLUMNS 1 -->
                                           <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                                               @php $__g = is_array($img) ? $img : (array) $img; @endphp
                                               @if(isset($__g[0]))
                                               <div class="trv-gallery-st1 l-pic">
                                                   <div class="trv-gallery-st1-media">
                                                       <img src="{{ $__g[0] }}" alt="{{ languageName($product->name) }}">
                                                       <a class="elem trv-gallery-st1-btn" href="{{ $__g[0] }}" title="{{ languageName($product->name) }}" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ $__g[0] }}" data-lcl-group="product-gallery"><i class="bi bi-arrows-fullscreen"></i>    
                                                       </a>
                                                   </div>
                                               </div> 
                                               @endif
                                               @if(isset($__g[1]))
                                               <div class="trv-gallery-st1 l-pic">
                                                   <div class="trv-gallery-st1-media">
                                                       <img src="{{ $__g[1] }}" alt="{{ languageName($product->name) }}">
                                                       <a class="elem trv-gallery-st1-btn" href="{{ $__g[1] }}" title="{{ languageName($product->name) }}" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ $__g[1] }}" data-lcl-group="product-gallery"><i class="bi bi-arrows-fullscreen"></i>    
                                                       </a>
                                                   </div>
                                               </div>  
                                               @endif                    
                                           </div>
                   
                                           <!-- COLUMNS 2 -->
                                           <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6  col-6">
                                               @if(isset($__g[2]))
                                               <div class="trv-gallery-st1 p-pic">
                                                   <div class="trv-gallery-st1-media">
                                                       <img src="{{ $__g[2] }}" alt="{{ languageName($product->name) }}">
                                                       <a class="elem trv-gallery-st1-btn" href="{{ $__g[2] }}" title="{{ languageName($product->name) }}" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ $__g[2] }}" data-lcl-group="product-gallery"><i class="bi bi-arrows-fullscreen"></i>    
                                                       </a>
                                                   </div>
                                               </div> 
                                               @endif
                                           </div>
                   
                                            <!-- COLUMNS 3 -->
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                @if(isset($__g[3]))
                                                <div class="trv-gallery-st1 p-pic">
                                                   <div class="trv-gallery-st1-media">
                                                       <img src="{{ $__g[3] }}" alt="{{ languageName($product->name) }}">
                                                       <a class="elem trv-gallery-st1-btn" href="{{ $__g[3] }}" title="{{ languageName($product->name) }}" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ $__g[3] }}" data-lcl-group="product-gallery"><i class="bi bi-arrows-fullscreen"></i>    
                                                       </a>
                                                   </div>
                                               </div> 
                                                @endif
                                            </div>
                                          
                                           
                                            @if(count($__g) > 4)
                                           <div class="col-12 text-center m-b20">
                                                <a href="{{ $__g[4] }}" class="elem butn-bg-shape" data-lcl-txt="" data-lcl-author="" data-lcl-thumb="{{ $__g[4] }}" data-lcl-group="product-gallery" style="text-decoration: underline; color: #85d200; font-weight: 700; font-style: italic;">View more images</a>
                                               <div style="display:none">
                                                    @foreach (array_slice($__g, 8) as $__extra)
                                                       <a class="elem" href="{{ $__extra }}" data-lcl-thumb="{{ $__extra }}" data-lcl-group="product-gallery" title="{{ languageName($product->name) }}"></a>
                                                   @endforeach
                                               </div>
                                           </div>
                                           @endif
                                               
                                       </div>
                                       
                                           
                                   </div> 
                                </div>

                                   <!-- Navigation -->
                                   <nav class="navbar-one">
                                       <a href="#overview">Overview</a>
                                       <a href="#itinerary">Day Wise Itinerary</a>
                                       <a href="#tourprice">Tour Price</a>
                                       <a href="#includes">Includes & Excludes</a>
                                   </nav>

                                   <!-- Over View-->
                                   <section id="overview" class="content">
                                    <div class="trv-tour-single-r-info">
                                       <div class="trv-main-rg-hol">
                                           <div class="trv-man-sec-hol">
                                               <ul>
                                                   <li>
                                                       <span class="trv-tmi-hlo"><i class="bi bi-clock"></i> Duration : </span>
                                                       <span class="ng-binding"> {{($product->hang_muc)}} Days </span>
                                                   </li>
                                                   <li>
                                                       <span  class="trv-tmi-hlo"><i class="bi bi-geo-alt"></i> Places to Visit :</span>
                                                       <span class="trv-tmi-hlo-info">
                                                            @if (!empty($ingredient) && is_array($ingredient))
                                                                @foreach ($ingredient as $key => $item)
                                                                    {{ languageName(json_encode($item->title)) }}@if($key < count($ingredient) - 1) | @endif
                                                                @endforeach
                                                            @endif
                                                       </span>
                                                   </li>
                                               </ul>
                                           </div>
                                           
                                       </div>
                                   </div>
                                   <div class="content">
                                    {!! languageName($product->content) !!}
                                   </div>
                                       

                                   </section>

                                   <!-- Day Wise Itinerary-->
                                   <section id="itinerary">

                                       <h3 class="trv-inner-title-sm">Day Wise Itinerary</h3>
                                   
                                       <div class="trv-clist-st-3-wrap">
                                           <ul class="trv-list-st-3">
                                               @foreach ($ingredient as $key => $item)
                                               <li>
                                                <div class="trv-list-content">
                                                    <div class="duration">
                                                        <span class="day">DAY</span>
                                                        <div class="media">
                                                            <div class="green-bg">{{$key + 1}}</div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="info">
                                                        <h4 class="trv-title">{{languageName(json_encode($item->title))}}</h4>
                                                        @php
                                                            $dayContent = languageName(json_encode($item->content));
                                                        @endphp
                                                        @if ($dayContent !== strip_tags($dayContent))
                                                            <div class="itinerary-html">{!! $dayContent !!}</div>
                                                        @else
                                                            {!! nl2br(e($dayContent)) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                               @endforeach
                                               

                                           </ul>
                                       </div>

                                   </section>

                                   <section id="tourprice">
                                       <h3 class="trv-inner-title-sm">Tour Price</h3>
                                       <div class="tour-price-box">
                                           <p class="tour-price-lead">Prices may vary depending on your travel dates, group size, hotel or cruise options etc. Please fill out the form below, and we will respond with a tailored quote.</p>

                                           @if(session('quote_error'))
                                           <div class="alert alert-danger tour-price-alert">{{ session('quote_error') }}</div>
                                           @endif
                                           @if($errors->any() && old('form_type') === 'quote')
                                           <div class="alert alert-danger tour-price-alert">{{ $errors->first() }}</div>
                                           @endif
                                           <div id="tour-price-client-error" class="alert alert-danger" style="display:none;"></div>

                                           <form id="tour-price-form" class="tour-price-form" method="post" action="{{ route('postBookTour') }}">
                                               @csrf
                                               <input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;height:0;width:0;opacity:0;" aria-hidden="true">
                                               <input type="hidden" name="form_type" value="quote">
                                               <input type="hidden" name="tour_id" value="{{ $product->id }}">
                                               <input type="hidden" name="service_id" value="">
                                               <input type="hidden" name="total" value="0">

                                               @php
                                                   $dialCountries = json_decode(file_get_contents(public_path('frontend/js/dial-codes.json')), true) ?: [];
                                                   $fallbackDial = ['iso' => 'VN', 'dial' => '+84', 'name' => 'Vietnam', 'label' => 'Vietnam (Việt Nam)'];
                                                   $pickDial = function ($iso) use ($dialCountries, $fallbackDial) {
                                                       foreach ($dialCountries as $dialCountry) {
                                                           if (($dialCountry['iso'] ?? '') === $iso) {
                                                               return $dialCountry;
                                                           }
                                                       }
                                                       return $fallbackDial;
                                                   };
                                                   $activeForm = old('form_type');
                                                   $quoteDial = $pickDial($activeForm === 'quote' ? old('phone_iso', 'VN') : 'VN');
                                                   $enquiryDial = $pickDial($activeForm === 'enquiry' ? old('phone_iso', 'VN') : 'VN');
                                                   $nationalities = ['Vietnamese', 'American', 'Argentine', 'Australian', 'Austrian', 'Belgian', 'Brazilian', 'British', 'Cambodian', 'Canadian', 'Chinese', 'Danish', 'Dutch', 'Filipino', 'Finnish', 'French', 'German', 'Indian', 'Indonesian', 'Irish', 'Italian', 'Japanese', 'Korean', 'Laotian', 'Malaysian', 'Mexican', 'New Zealander', 'Norwegian', 'Russian', 'Singaporean', 'Spanish', 'Swedish', 'Swiss', 'Taiwanese', 'Thai'];
                                               @endphp
                                               <script type="application/json" id="tour-dial-codes">{!! json_encode($dialCountries, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label">Travel date</label>
                                                   <div class="tour-price-radios">
                                                       <label>
                                                           <input type="radio" name="date_type" value="specific" {{ (old('form_type') === 'quote' ? old('date_type', 'specific') : 'specific') === 'specific' ? 'checked' : '' }}>
                                                           Specific Date
                                                       </label>
                                                       <label>
                                                           <input type="radio" name="date_type" value="flexible" {{ old('form_type') === 'quote' && old('date_type') === 'flexible' ? 'checked' : '' }}>
                                                           Flexible Date
                                                       </label>
                                                   </div>
                                               </div>

                                               <div class="tour-price-row tour-price-row-follow {{ old('form_type') === 'quote' && old('travel_date') ? 'has-value' : '' }}" id="tour-price-date-row">
                                                   <div class="tour-price-field tour-price-date">
                                                       <i class="bi bi-calendar3"></i>
                                                       <span class="tour-price-date-hint">Specific Date</span>
                                                       <input type="date" name="travel_date" value="{{ old('form_type') === 'quote' ? old('travel_date') : '' }}" min="{{ date('Y-m-d') }}" aria-label="Specific Date" required>
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label" for="tour-price-name">Full name</label>
                                                   <div class="tour-price-field">
                                                       <input id="tour-price-name" type="text" name="name" placeholder="Your full name" required maxlength="191" value="{{ old('form_type') === 'quote' ? old('name') : '' }}">
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label" for="tour-price-email">Email</label>
                                                   <div class="tour-price-field">
                                                       <i class="bi bi-envelope"></i>
                                                       <input id="tour-price-email" type="email" name="email" placeholder="Your email address" required maxlength="191" value="{{ old('form_type') === 'quote' ? old('email') : '' }}">
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label" for="tour-price-email-confirm">Confirm email</label>
                                                   <div class="tour-price-field">
                                                       <i class="bi bi-envelope"></i>
                                                       <input id="tour-price-email-confirm" type="email" name="email_confirm" placeholder="Your email address" required maxlength="191" value="{{ old('form_type') === 'quote' ? old('email_confirm') : '' }}">
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label" for="tour-price-phone">Phone</label>
                                                   <div class="tour-price-phone js-dial-phone">
                                                       <button type="button" class="tour-price-dial-btn" data-dial-btn aria-haspopup="listbox" aria-expanded="false" aria-label="Country code {{ $quoteDial['label'] }}">
                                                           <img class="tour-price-flag-img" data-dial-flag src="https://flagcdn.com/w40/{{ strtolower($quoteDial['iso']) }}.png" alt="">
                                                           <span data-dial-label>{{ $quoteDial['dial'] }}</span>
                                                           <i class="bi bi-chevron-down"></i>
                                                       </button>
                                                       <input id="tour-price-phone" type="tel" name="phone" placeholder="Your phone number" required maxlength="30" value="{{ old('form_type') === 'quote' ? old('phone') : '' }}">
                                                       <div class="tour-price-dial-menu" data-dial-menu role="listbox" hidden></div>
                                                       <input type="hidden" name="phone_code" data-dial-code value="{{ $quoteDial['dial'] }}">
                                                       <input type="hidden" name="phone_country" data-dial-country value="{{ $quoteDial['name'] }}">
                                                       <input type="hidden" name="phone_iso" data-dial-iso value="{{ $quoteDial['iso'] }}">
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label" for="tour-price-hotel">Hotel category</label>
                                                   <div class="tour-price-field">
                                                       <select id="tour-price-hotel" name="hotel_category" required>
                                                           @foreach (['2 Stars', '3 Stars', '4 Stars', '5 Stars', 'Cruise'] as $hotel)
                                                           <option value="{{ $hotel }}" {{ (old('form_type') === 'quote' ? old('hotel_category', '3 Stars') : '3 Stars') === $hotel ? 'selected' : '' }}>{{ $hotel }}</option>
                                                           @endforeach
                                                       </select>
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <label class="tour-price-label" for="tour-price-travellers">Number of travellers</label>
                                                   <div class="tour-price-field">
                                                       <select id="tour-price-travellers" name="travellers" required>
                                                           @for ($persons = 1; $persons <= 20; $persons++)
                                                           <option value="{{ $persons }}" {{ (int) (old('form_type') === 'quote' ? old('travellers', 2) : 2) === $persons ? 'selected' : '' }}>{{ $persons }} {{ $persons === 1 ? 'Person' : 'Persons' }}</option>
                                                           @endfor
                                                       </select>
                                                   </div>
                                               </div>

                                               <div class="tour-price-row">
                                                   <span class="tour-price-label">Verification code</span>
                                                   <div class="tour-price-captcha">
                                                       <div class="simple-captcha-box">
                                                           <img id="tour-price-captcha-img" class="simple-captcha-image" src="{{ route('contactCaptcha', ['scope' => 'quote']) }}" alt="Captcha">
                                                           <button type="button" class="simple-captcha-refresh" onclick="refreshTourPriceCaptcha()">Refresh</button>
                                                       </div>
                                                       <input class="form-control mt-2" name="captcha_code" type="text" required maxlength="4" pattern="[0-9]{4}" inputmode="numeric" autocomplete="off" placeholder="Enter 4 digits in the image">
                                                   </div>
                                               </div>

                                               <div class="tour-price-actions">
                                                   <button type="submit" class="site-button butn-bg-shape">SUBMIT</button>
                                               </div>
                                           </form>
                                       </div>
                                   </section>

                                   <section id="includes">
                                       @php
                                           $priceIncludes = array_values(array_filter((array) json_decode($product->price_includes, true), function ($item) {
                                               return trim((string) $item) !== '';
                                           }));
                                           $priceExcludes = array_values(array_filter((array) json_decode($product->price_excludes, true), function ($item) {
                                               return trim((string) $item) !== '';
                                           }));
                                       @endphp
                                       <div class="price-split">
                                           <div>
                                               <h4>Price includes</h4>
                                               @if (count($priceIncludes))
                                               <ul>
                                                   @foreach ($priceIncludes as $item)
                                                   <li>{{ $item }}</li>
                                                   @endforeach
                                               </ul>
                                               @endif
                                           </div>
                                           <div class="price-split-excludes">
                                               <h4>Price excludes</h4>
                                               @if (count($priceExcludes))
                                               <ul>
                                                   @foreach ($priceExcludes as $item)
                                                   <li>{{ $item }}</li>
                                                   @endforeach
                                               </ul>
                                               @endif
                                           </div>
                                       </div>
                                   </section>

                               </div>

                           </div>
                       </div> 
                   </div> 

                   <!-- SIDE BAR START -->
                   <div class="col-xl-4 col-lg-4 col-md-12 rightSidebar  m-b30">
                   
                       <aside  class="side-bar">
                        <div class="trv-tour-single-r-detail">
                           @php
                               $adultPrice = (float) languageName($product->price);
                               $listPrice = (float) languageName($product->discount);
                           @endphp
                           <span class="trv-star-from">Price</span>
                           <span class="trv-star-amount">
                               @if ($adultPrice > 0)
                                   @if ($listPrice > $adultPrice)
                                       <s>{{ number_format($listPrice) }}đ</s>
                                   @endif
                                   <span class="trv-star-now">{{ number_format($adultPrice) }}đ</span> / Person
                               @else
                                   <span class="trv-star-now">Contact Us</span>
                               @endif
                           </span>
                       </div>
                        <div class="twm-post-com-wrap">
                           <div class="clear" id="comment-list">
                               <div class="comments-area" id="comments">
                                  <div>
                                       
                                       <!-- LEAVE A REPLY START -->
                                       <div class="comment-respond trv-form" id="respond">
           
                                           <!-- TITLE START-->
                                           <div class="section-head trv-head-title-wrap left-position">
                                               <h2 class="trv-head-title"><span class="site-text-yellow">Booking</span> This Tour</h2>
                                               <div class="trv-head-discription">You can book this tour by filling the form below</div>
                                           </div>
                                           <!-- TITLE END-->
           
                                           <form id="booking-enquiry-form" class="trv-cons-contact-form booking-enquiry" method="post" action="{{route('postBookTour')}}">
                                            @csrf
                                            <input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;height:0;width:0;opacity:0;" aria-hidden="true">
                                            <input type="hidden" name="form_type" value="enquiry">
                                            <input type="hidden" name="tour_id" value="{{$product->id}}">
                                            <input type="hidden" name="service_id" value="{{isset($servicereqest) ? json_encode($servicereqest) : ''}}">
                                            <input type="hidden" name="total" value="0">
                                            @php $isEnquiryOld = old('form_type') === 'enquiry'; @endphp
                                            @if(session('error'))
                                            <div class="alert alert-danger booking-enquiry-alert">{{ session('error') }}</div>
                                            @endif
                                            <div id="booking-client-error" class="alert alert-danger" style="display:none;"></div>

                                               <div class="form-group">
                                                   <label class="form-label" for="booking-hotel">Hotel category?</label>
                                                   <select id="booking-hotel" class="form-control" name="hotel_category" required>
                                                       <option value="" {{ $isEnquiryOld && old('hotel_category') ? '' : 'selected' }} disabled>Hotel category?</option>
                                                       @foreach (['2 Stars', '3 Stars', '4 Stars', '5 Stars', 'Cruise'] as $hotel)
                                                       <option value="{{ $hotel }}" {{ $isEnquiryOld && old('hotel_category') === $hotel ? 'selected' : '' }}>{{ $hotel }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-people">How many people?</label>
                                                   <select id="booking-people" class="form-control" name="travellers" required>
                                                       <option value="" {{ $isEnquiryOld && old('travellers') ? '' : 'selected' }} disabled>How many people?</option>
                                                       @for ($persons = 1; $persons <= 20; $persons++)
                                                       <option value="{{ $persons }}" {{ $isEnquiryOld && (int) old('travellers') === $persons ? 'selected' : '' }}>{{ $persons }} {{ $persons === 1 ? 'Person' : 'Persons' }}</option>
                                                       @endfor
                                                   </select>
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-date">Travel date</label>
                                                   <input id="booking-date" class="form-control" type="date" name="travel_date" required min="{{ date('Y-m-d') }}" value="{{ $isEnquiryOld ? old('travel_date') : '' }}">
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-name">Full name</label>
                                                   <input id="booking-name" class="form-control" type="text" placeholder="Your full name" name="name" required maxlength="191" value="{{ $isEnquiryOld ? old('name') : '' }}">
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-email">Email</label>
                                                   <input id="booking-email" class="form-control" type="email" placeholder="example@mail.com" name="email" required maxlength="191" value="{{ $isEnquiryOld ? old('email') : '' }}">
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-email-confirm">Confirm email</label>
                                                   <input id="booking-email-confirm" class="form-control" type="email" placeholder="example@mail.com" name="email_confirm" required maxlength="191" value="{{ $isEnquiryOld ? old('email_confirm') : '' }}">
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-phone">Phone number *</label>
                                                   <div class="tour-price-phone js-dial-phone">
                                                       <button type="button" class="tour-price-dial-btn" data-dial-btn aria-haspopup="listbox" aria-expanded="false" aria-label="Country code {{ $enquiryDial['label'] }}">
                                                           <img class="tour-price-flag-img" data-dial-flag src="https://flagcdn.com/w40/{{ strtolower($enquiryDial['iso']) }}.png" alt="">
                                                           <span data-dial-label>{{ $enquiryDial['dial'] }}</span>
                                                           <i class="bi bi-chevron-down"></i>
                                                       </button>
                                                       <input id="booking-phone" type="tel" name="phone" placeholder="Your telephone" required maxlength="30" value="{{ $isEnquiryOld ? old('phone') : '' }}">
                                                       <div class="tour-price-dial-menu" data-dial-menu role="listbox" hidden></div>
                                                       <input type="hidden" name="phone_code" data-dial-code value="{{ $enquiryDial['dial'] }}">
                                                       <input type="hidden" name="phone_country" data-dial-country value="{{ $enquiryDial['name'] }}">
                                                       <input type="hidden" name="phone_iso" data-dial-iso value="{{ $enquiryDial['iso'] }}">
                                                   </div>
                                                   <p class="booking-phone-note">* To ensure you receive our itinerary (in case of email failure)</p>
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-nationality">Nationality</label>
                                                   <select id="booking-nationality" class="form-control" name="nationality" required>
                                                       @foreach ($nationalities as $nationality)
                                                       <option value="{{ $nationality }}" {{ ($isEnquiryOld ? old('nationality', 'Vietnamese') : 'Vietnamese') === $nationality ? 'selected' : '' }}>{{ $nationality }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                               <div class="form-group">
                                                   <label class="form-label" for="booking-message">Message</label>
                                                   <textarea id="booking-message" class="form-control" placeholder="Message" name="note" maxlength="5000">{{ $isEnquiryOld ? old('note') : '' }}</textarea>
                                               </div>
                                               @include('layouts.partials.simple-captcha')
                                               <button type="submit" class="site-button butn-bg-shape">Send Enquiry</button>
                                           </form>
                                           
           
                                       </div>
                                       <!-- LEAVE A REPLY END -->
                                   </div>
                               </div>
                           </div>
                       </div>

                   </div>
           </div>                
       </div>   

                          

                       </aside>

                   </div>
                   <!-- SIDE BAR END -->
               
               </div>

           </div>
           
       </div>
       
   </div>   
   <!-- SECTION END --> 
   <div class="section-full p-t40 p-b0 trv-we-recommend">
      <div class="container-fluid">
          <!-- TITLE START-->
          <div class="section-head trv-head-title-wrap center-position">
              <h2 class="trv-head-title">You May Interested With</h2>
              <div class="trv-head-title-image">
                  <img src="/frontend/images/Title-Separator.png" alt="Image">
              </div>
          </div>
          <!-- TITLE END-->

          <div class="section-content">

              <div class="swiper trv-popular-tours-row trv-tours-st1-carousal swiper-nav-center-bottom">
                  <div class="swiper-wrapper">
                      @foreach ($productlq as $item)
                          <div class="swiper-slide">
                              @include('layouts.product.item', ['pro' => $item])
                          </div>
                      @endforeach
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
              </div>

          </div>

      </div>

  </div>




</div>
@endsection