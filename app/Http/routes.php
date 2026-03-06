<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Back
 */

use Carbon\Carbon;
use App\CategoryModel;
use App\ProductModel;
use Illuminate\Support\Facades\URL;

// use URL;
// use App;

$router->group([
    'namespace' => 'Admin\Controllers',
    'prefix'    => '_admin'
], function ($router) {
    Route::any('/', function () {
        return Redirect::to('_admin/login');
    });
    Route::get('/logout', array('as' => 'admin_logout', 'uses' => 'Login@do_logout'));
    Route::any('/login/dologin', array('as' => 'admin_login_process', 'uses' => 'Login@do_login'));
    Route::get('/login', array('as' => 'admin_login', 'uses' => 'Login@index'));

    $router->group([
        'middleware'    => 'admin_auth'
    ], function ($router) {
        /**
         * any new Routers here, because there is middleware for user auth
         * so another people cannt access directly
         */
        Route::any('/dashboard', array('as' => 'admin_dashboard', 'uses' => 'Dashboard@index'));

        Route::any('/slideshow', array('as' => 'admin_slideshow', 'uses' => 'Slideshow@index'));
        Route::any('/header_link', array('as' => 'admin_header_link', 'uses' => 'Content@header_link'));
        Route::any('/banner', array('as' => 'admin_banner', 'uses' => 'Content@banner'));
        Route::any('/home_video', array('as' => 'admin_home_video', 'uses' => 'Content@video'));
        Route::any('/footer', array('as' => 'admin_footer', 'uses' => 'Content@footer'));

        Route::any('/pages', array('as' => 'admin_pages', 'uses' => 'Pages@index'));

        Route::any('/static_pages', array('as' => 'admin_static_pages', 'uses' => 'StaticPages@index'));
        Route::any('/about', array('as' => 'admin_about', 'uses' => 'About@index'));
        Route::any('/upcoming_events', array('as' => 'admin_upcoming_events', 'uses' => 'UpcomingEvents@index'));
        Route::any('/meet_our_suppliers', array('as' => 'admin_meet_our_suppliers', 'uses' => 'MeetOurSuppliers@index'));
        Route::any('/why_choose_us', array('as' => 'admin_why_choose_us', 'uses' => 'WhyChooseUs@index'));
        Route::any('/industrial_line', array('as' => 'admin_industrial_line', 'uses' => 'IndustrialLine@index'));

        Route::any('/contact_message', array('as' => 'admin_contact_message', 'uses' => 'ContactMessage@index'));
        Route::any('/contact_address', array('as' => 'admin_contact_address', 'uses' => 'ContactAddress@index'));

        Route::any('/administrator', array('as' => 'admin_administrator', 'uses' => 'Administrator@index'));
        Route::any('/setting', array('as' => 'admin_setting', 'uses' => 'Setting@index'));
        Route::any('/google_analytics', array('as' => 'admin_ga', 'uses' => 'Setting@ga'));
        Route::any('/newsletter', array('as' => 'admin_newsletter', 'uses' => 'Newsletter@index'));
        Route::any('/social_link', array('as' => 'admin_social_link', 'uses' => 'SocialLink@index'));
        Route::any('/seo', array('as' => 'admin_seo', 'uses' => 'Content@seo'));

        Route::any('/product', array('as' => 'admin_product', 'uses' => 'Product@index'));
        Route::any('/product_image', array('as' => 'admin_product_image', 'uses' => 'ProductImage@index'));
        Route::any('/brands', array('as' => 'admin_brands', 'uses' => 'Brand@index'));
        Route::any('/categories', array('as' => 'admin_categories', 'uses' => 'Category@index'));
    });
});

/**
 * Front
 */
$router->group([
    'namespace' => 'Http\Controllers'
], function ($router) {
    Route::get('/sitemap', function () {
        //Pages
        $sitemap = App::make("sitemap");
        $sitemap->add(URL::to('/'), Carbon::now());
        $sitemap->add(URL::to('/about'), Carbon::now());
        $sitemap->add(URL::to('/product'), Carbon::now());        
        $sitemap->add(URL::to('/page/food-service'), Carbon::now());
        $sitemap->add(URL::to('/industrial-line'), Carbon::now());
        $sitemap->add(URL::to('/contact'), Carbon::now());
        $sitemap->add(URL::to('/category'), Carbon::now());

        //Category 
        $sitemap->add(URL::to('/category/blast-freezer'), Carbon::now());
        $sitemap->add(URL::to('/category/bread-line'), Carbon::now());
        $sitemap->add(URL::to('/category/chiller'), Carbon::now());
        $sitemap->add(URL::to('/category/cooking-mixer'), Carbon::now());
        $sitemap->add(URL::to('/category/divider-rounder'), Carbon::now());
        $sitemap->add(URL::to('/category/dough-moulder'), Carbon::now());
        $sitemap->add(URL::to('/category/dough-sheeter'), Carbon::now());
        $sitemap->add(URL::to('/category/filling-and-dosing'), Carbon::now());
        $sitemap->add(URL::to('/category/final-proofer'), Carbon::now());
        $sitemap->add(URL::to('/category/freezer'), Carbon::now());
        $sitemap->add(URL::to('/category/fryer'), Carbon::now());
        $sitemap->add(URL::to('/category/miscellaneous'), Carbon::now());
        $sitemap->add(URL::to('/category/modular-oven'), Carbon::now());
        $sitemap->add(URL::to('/category/pizza-oven'), Carbon::now());
        $sitemap->add(URL::to('/category/planetary-mixer'), Carbon::now());
        $sitemap->add(URL::to('/category/retarder-proofer'), Carbon::now());
        $sitemap->add(URL::to('/category/showcase'), Carbon::now());
        $sitemap->add(URL::to('/category/spiral-mixer'), Carbon::now());
        $sitemap->add(URL::to('/category/various-ovens'), Carbon::now());
       
        //Brand
        $sitemap->add(URL::to('/brand'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/artesano'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/belshaw-usa'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/bernadi'), Carbon::now());
        $sitemap->add(URL::to('/brand/bresso'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chan-mag'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chih-hsing'), Carbon::now());
        $sitemap->add(URL::to('/brand/chung-hou'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/chung-shen'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/daub'), Carbon::now());
        $sitemap->add(URL::to('/brand/edhard-usa-2'), Carbon::now());
        $sitemap->add(URL::to('/brand/effe-uno'), Carbon::now());
        $sitemap->add(URL::to('/brand/eurofours'), Carbon::now());
        $sitemap->add(URL::to('/brand/ferneto'), Carbon::now());
        $sitemap->add(URL::to('/brand/jendah-taiwan'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/merlin-perkins'), Carbon::now());
        $sitemap->add(URL::to('/brand/mimac'), Carbon::now());
        $sitemap->add(URL::to('/brand/minipan-taiwan'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/panem'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/pavoni-italia'), Carbon::now());
        $sitemap->add(URL::to('/brand/pizza-master'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/revent'), Carbon::now());
        $sitemap->add(URL::to('/brand/rondo'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/sunmix'), Carbon::now());
        $sitemap->add(URL::to('/brand/vmi'), Carbon::now());    
        $sitemap->add(URL::to('/brand/wachtel'), Carbon::now());  
        $sitemap->add(URL::to('/brand/yang-jenq-taiwan-1'), Carbon::now()); 
        $sitemap->add(URL::to('/brand/yuan-jan-taiwan'), Carbon::now());  
        
        //Product category
        //blast-freezer
        $sitemap->add(URL::to('/product/category/blast-freezer/blast-freezer-16-trays'), Carbon::now());
        $sitemap->add(URL::to('/product/category/blast-freezer/blast-frezeer-10-tray'), Carbon::now());
       
        //breadline
        $sitemap->add(URL::to('/product/category/bread-line/automatic-bread-line'), Carbon::now());
        $sitemap->add(URL::to('/product/category/bread-line/filling-depositor'), Carbon::now());
        $sitemap->add(URL::to('/product/category/bread-line/moon-cake-machine'), Carbon::now());
        $sitemap->add(URL::to('/product/category/bread-line/twist-dividing-machine'), Carbon::now());
      
        //Chiller
        $sitemap->add(URL::to('/product/category/chiller/undercounter-chiller-2-door'), Carbon::now());
        $sitemap->add(URL::to('/product/category/chiller/upright-chiller-2-doors'), Carbon::now());
        $sitemap->add(URL::to('/product/category/chiller/upright-chiller-4-doors'), Carbon::now());
       
        //Cooking Mixer
        $sitemap->add(URL::to('/product/category/cooking-mixer/gas-cooking-mixer-double-jacket'), Carbon::now());
        $sitemap->add(URL::to('/product/category/cooking-mixer/gas-cooking-mixer-single-jacket'), Carbon::now());
        $sitemap->add(URL::to('/product/category/cooking-mixer/steam-cooking-mixer-double-jacket'), Carbon::now());
        $sitemap->add(URL::to('/product/category/cooking-mixer/steam-cooking-mixer-single-jacket-new'), Carbon::now());
       
        //divider rounder
        $sitemap->add(URL::to('/product/category/divider-rounder/automatic-divider-rounder'), Carbon::now());
        $sitemap->add(URL::to('/product/category/divider-rounder/hydraulic-divider'), Carbon::now());
        $sitemap->add(URL::to('/product/category/divider-rounder/manual-divider'), Carbon::now());
        $sitemap->add(URL::to('/product/category/divider-rounder/semi-auto-divider-rounder'), Carbon::now());
       
        //dough-moulder
        $sitemap->add(URL::to('/product/category/dough-moulder/automatic-dough-break'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-moulder/dough-moulder-long'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-moulder/dough-moulder-short'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-moulder/dough-rolling-machine'), Carbon::now());
        
        //dough-sheeter
        $sitemap->add(URL::to('/product/category/dough-sheeter/dough-sheeter'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-sheeter/dough-sheeter-sso514'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-sheeter/portable-dough-sheeter'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-sheeter/portable-dough-sheeter-2'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-sheeter/standing-dough-sheeter'), Carbon::now());
        $sitemap->add(URL::to('/product/category/dough-sheeter/standing-dough-sheeter-with-foot-switch'), Carbon::now());

        //filling-and-dosing
        $sitemap->add(URL::to('/product/category/filling-and-dosing/filing-depositor'), Carbon::now());

        //final-proofer
        $sitemap->add(URL::to('/product/category/final-proofer/final-prover-2-door'), Carbon::now());
        $sitemap->add(URL::to('/product/category/final-proofer/final-prover-double-door'), Carbon::now());
        $sitemap->add(URL::to('/product/category/final-proofer/final-prover-double-door-2'), Carbon::now());
        $sitemap->add(URL::to('/product/category/final-proofer/final-prover-single-door'), Carbon::now());

        //freezer
        $sitemap->add(URL::to('/product/category/freezer/undercounter-freezer-2-doors'), Carbon::now());
        $sitemap->add(URL::to('/product/category/freezer/upright-freezer-2-doors'), Carbon::now());
        $sitemap->add(URL::to('/product/category/freezer/upright-freezer-4-doors'), Carbon::now());

        //fryer
        $sitemap->add(URL::to('/product/category/fryer/gas-automatic-donut-fryer'), Carbon::now());
        $sitemap->add(URL::to('/product/category/fryer/gas-fryer-large'), Carbon::now());
        $sitemap->add(URL::to('/product/category/fryer/gas-fryer-regular'), Carbon::now());

        //miscellaneous
        $sitemap->add(URL::to('/product/category/miscellaneous/artebake-43'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/artemix-05'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/artepuff-300-black'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/artepuff-300-red'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/artepuff-300-yellow'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/berto-mag-line-spiral-mixers'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/cake-depositor'), Carbon::now());
        //$sitemap->add(URL::to('/product/category/miscellaneous/chocolate-warmer-2-bowls'), Carbon::now());
        //$sitemap->add(URL::to('/product/category/miscellaneous/chocolate-warmer-6-bowls'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/electric heated baking oven - 3 tray'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/flour-shifter-regular'), Carbon::now());
        //$sitemap->add(URL::to('/product/category/miscellaneous/flour-sifter'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/gas deck oven - 2 tray'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/industrial-pie-tart-machine'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/mimac-suprema'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/planetary-mixer-20-80lt'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/steamer-bakpao-KS-610(3)'), Carbon::now());
        $sitemap->add(URL::to('/product/category/miscellaneous/tartlet-machine'), Carbon::now());

        //modular-oven
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-electric-deck-oven-3-deck-2-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-electric-deck-oven-3-deck-3-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-electric-deck-oven-3-deck-4-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-electric-deck-oven-4-deck-4-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-gas-deck-oven-3-deck-2-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-gas-deck-oven-3-deck-3-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/automatic-gas-deck-oven-3-deck-4-tray-perdeck'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/electric-heatead-baking-oven'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/electric-heatead-baking-oven-2'), Carbon::now());
        $sitemap->add(URL::to('/product/category/modular-oven/gas-heated-baking-oven'), Carbon::now());

        //pizza-oven
        $sitemap->add(URL::to('/product/category/pizza-oven/gas-heated-baking-oven'), Carbon::now());
        //$Sitemap Product category
        // $sitemap->add(URL::to('/steam-cooking-mixer-double-jacket'), Carbon::now());
        // $sitemap->add(URL::to('/planetary-mixer-40lt-5kg'), Carbon::now());
        // $sitemap->add(URL::to('/dough-kneader-5kg'), Carbon::now());
        // $sitemap->add(URL::to('/planetary-mixer-80lt'), Carbon::now());
        // $sitemap->add(URL::to('/rectangular-cold-showcase-2'), Carbon::now());
        // $sitemap->add(URL::to('/final-prover-double-door'), Carbon::now());
        // $sitemap->add(URL::to('/gas-heated-baking-oven'), Carbon::now());
        // $sitemap->add(URL::to('/upright-chiller-4-doors'), Carbon::now());
        // $sitemap->add(URL::to('/undercounter-chiller-2-door'), Carbon::now());
        // $sitemap->add(URL::to('/dough-kneader-75kg'), Carbon::now());
        // $sitemap->add(URL::to('/retarder-proofer-double-cabinet'), Carbon::now());
        // $sitemap->add(URL::to('/dough-moulder-short'), Carbon::now());
        // $sitemap->add(URL::to('/rectangular-cold-showcase'), Carbon::now());
        // $sitemap->add(URL::to('/standing-dough-sheeter-with-foot-switch'), Carbon::now());
        // $sitemap->add(URL::to('/dough-kneader-12kg'), Carbon::now());
        // $sitemap->add(URL::to('/gas-cooking-mixer-single-jacket'), Carbon::now());
        // $sitemap->add(URL::to('/final-prover-double-door-2'), Carbon::now());
        // $sitemap->add(URL::to('/dough-moulder-long'), Carbon::now());
        // $sitemap->add(URL::to('/final-prover-single-door'), Carbon::now());
        // $sitemap->add(URL::to('/planetary-mixer-60lt'), Carbon::now());
        // $sitemap->add(URL::to('/upright-chiller-2-doors'), Carbon::now());
        // $sitemap->add(URL::to('/automatic-dough-break'), Carbon::now());
        // $sitemap->add(URL::to('/manual-divider'), Carbon::now());
        // $sitemap->add(URL::to('/semi-auto-divider-rounder'), Carbon::now());
        // $sitemap->add(URL::to('/hydraulic-divider'), Carbon::now());
        // $sitemap->add(URL::to('/portable-dough-sheeter'), Carbon::now());
        // $sitemap->add(URL::to('/portable-dough-sheeter-2'), Carbon::now());
        // $sitemap->add(URL::to('/retarder-proofer-single-cabinet'), Carbon::now());
        // $sitemap->add(URL::to('/retarder-proofer-trolley'), Carbon::now());
        // $sitemap->add(URL::to('/retarder-proofer-trolley'), Carbon::now());
        // $sitemap->add(URL::to('/electric-heatead-baking-oven'), Carbon::now());
        // $sitemap->add(URL::to('/electric-heatead-baking-oven-2'), Carbon::now());
        // $sitemap->add(URL::to('/gas-convection-oven'), Carbon::now());
        // $sitemap->add(URL::to('/electric-convection-oven'), Carbon::now());
        // $sitemap->add(URL::to('/electric-convection-oven'), Carbon::now());
        return $sitemap->render('xml');
    });

    Route::get('/', function () {
        return Redirect::to('home');
    });
    Route::get('home', array('as' => 'home', 'uses' => 'HomePage@index'));
    Route::any('page/{permalink}', array('as' => 'pages', 'uses' => 'Page@load'));

    Route::get('product/{type}/{name}/{detail}', array('as' => 'product', 'uses' => 'Product@detail'));
    Route::get('category', array('as' => 'category_null', 'uses' => 'Product@category'));
    Route::get('category/{name}', array('as' => 'category', 'uses' => 'Product@category'));
    Route::get('brand', array('as' => 'brand_null', 'uses' => 'Product@brand'));
    Route::get('brand/{name}', array('as' => 'brand', 'uses' => 'Product@brand'));

    Route::post('send_message', array('as' => 'send_message', 'uses' => 'Process@sendMessage'));
    Route::any('search/', array('as' => 'search', 'uses' => 'Search@index'));
    Route::any('search/{permalink}', array('as' => 'search_params', 'uses' => 'Search@search'));
    Route::post('process/subscribe', array('as' => 'dosubscribe', 'uses' => 'Process@do_subscribe'));
    Route::get('not-found', array('as' => 'error-page', 'uses' => 'Page@error'));

    Route::any('{permalink}', array('as' => 'single-page', 'uses' => 'Page@create'));
});
