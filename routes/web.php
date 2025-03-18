<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BenevoleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AxeController;
use App\Http\Controllers\Admin\FunFactController;
use App\Http\Controllers\Admin\StatFactController;
use App\Http\Controllers\Admin\HeaderSliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\EquipeCategoryController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\GalerieController;
use App\Http\Controllers\Admin\HeaderFooterSettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\ProjectController as FrontendProjectController;
use App\Http\Controllers\Frontend\GalerieController as FrontendGalerieController;
use App\Http\Controllers\Frontend\TeamController as FrontendTeamController;
use App\Http\Controllers\Admin\GalerieCategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NewsletterController;
// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [FrontendAboutController::class, 'index'])->name('about');
Route::get('/equipe', [FrontendTeamController::class, 'index'])->name('team');
Route::get('/donation', [FrontendContactController::class, 'donation'])->name('donation');
Route::get('/opportunites', [FrontendAboutController::class, 'axes'])->name('axes');
Route::get('/opportunites/{slug}', [FrontendAboutController::class, 'show'])->name('axes.show');
Route::get('/partenaires', [FrontendAboutController::class, 'partners'])->name('partners');

Route::get('/contact', [FrontendContactController::class, 'index'])->name('contact');
Route::post('/contact', [FrontendContactController::class, 'store'])->name('contact.store');
Route::get('/benevole', [FrontendContactController::class, 'benevole'])->name('benevole');
Route::post('/benevole', [FrontendContactController::class, 'storeBenevole'])->name('benevole.store');

Route::post('newsletter', [FrontendContactController::class, 'newsletter'])->name('newsletter.store');

Route::get('/actualites', [FrontendNewsController::class, 'index'])->name('news.index');
Route::get('/actualites/{slug}', [FrontendNewsController::class, 'show'])->name('news.show');
Route::get('/actualites/categorie/{slug}', [FrontendNewsController::class, 'category'])->name('news.category');

Route::get('/projets', [FrontendProjectController::class, 'index'])->name('projects.index');
Route::get('/projets/{slug}', [FrontendProjectController::class, 'show'])->name('projects.show');

Route::get('/galerie', [FrontendGalerieController::class, 'index'])->name('galerie.index');
Route::get('/galerie/{id}', [FrontendGalerieController::class, 'show'])->name('galerie.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Users
        Route::resource('users', UserController::class);
        
        // Benevoles
        Route::resource('benevoles', BenevoleController::class);

        
        // Contacts
        Route::resource('contacts', ContactController::class);
        Route::post('contacts/destroy-multiple', [ContactController::class, 'destroyMultiple'])->name('contacts.destroyMultiple');
        
        // Newsletter
        Route::resource('newsletters', NewsletterController::class);
        
        // About
        Route::get('/about', [AboutController::class, 'index'])->name('about.index');
        Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');
        
        // Testimonials
        
        Route::resource('testimonials', TestimonialController::class);
        Route::post('testimonials/update-order', [TestimonialController::class, 'updateOrder'])->name('testimonials.update-order');
        
        // Axes
        Route::resource('axes', AxeController::class);
        Route::post('axes/update-order', [AxeController::class, 'updateOrder'])->name('axes.update-order');
        
        // Fun Facts
        Route::resource('fun-facts', FunFactController::class);
        Route::post('fun-facts/update-order', [FunFactController::class, 'updateOrder'])->name('fun-facts.update-order');
        
        // Stat Facts
        Route::resource('stat-facts', StatFactController::class);
        Route::post('stat-facts/update-order', [StatFactController::class, 'updateOrder'])->name('stat-facts.update-order');
        
        // Header Sliders
        Route::resource('header-sliders', HeaderSliderController::class);
        Route::post('header-sliders/update-order', [HeaderSliderController::class, 'updateOrder'])->name('header-sliders.update-order');
        
        // Partners
        Route::resource('partners', PartnerController::class);
        Route::post('partners/update-order', [PartnerController::class, 'updateOrder'])->name('partners.update-order');
        
        // Equipe Categories
        Route::resource('equipe-categories', EquipeCategoryController::class);
        Route::post('equipe-categories/update-order', [EquipeCategoryController::class, 'updateOrder'])->name('equipe-categories.update-order');
        
        // Equipe
        Route::resource('equipes', EquipeController::class);
        Route::post('equipes/update-order', [EquipeController::class, 'updateOrder'])->name('equipes.updateOrder');
        
        // News Categories
        Route::resource('news-categories', NewsCategoryController::class);
        Route::post('news-categories/update-order', [NewsCategoryController::class, 'updateOrder'])->name('news-categories.update-order');
        
        // News
        Route::resource('news', NewsController::class);
        
        // Projects
        Route::resource('projects', ProjectController::class);
        
        // Galerie
        Route::prefix('gallery')->group(function () {
            Route::get('/categories', [GalerieCategoryController::class, 'index'])->name('gallery.categories.index');
            Route::post('/categories', [GalerieCategoryController::class, 'store'])->name('gallery.categories.store');
            Route::put('/categories/{category}', [GalerieCategoryController::class, 'update'])->name('gallery.categories.update');
            Route::delete('/categories/{category}', [GalerieCategoryController::class, 'destroy'])->name('gallery.categories.destroy');
        });

        Route::resource('gallery', GalerieController::class);
        Route::post('gallery/update-order', [GalerieController::class, 'updateOrder'])->name('gallery.update-order');
        
        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
        
        // Sliders
        Route::resource('sliders', SliderController::class);
        Route::post('sliders/update-order', [SliderController::class, 'updateOrder'])->name('sliders.update-order');
        
        // Header Footer Settings
        Route::resource('header-footer-settings', HeaderFooterSettingController::class);

        // Profile
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

        // Routes pour les pages
        Route::resource('pages', 'App\Http\Controllers\Admin\PageController');
        
        // Routes pour les sections d'une page
        Route::group(['prefix' => 'pages/{page}'], function () {
            Route::get('sections', [\App\Http\Controllers\Admin\PageSectionController::class, 'index'])->name('page_sections.index');
            Route::get('sections/create', [\App\Http\Controllers\Admin\PageSectionController::class, 'create'])->name('page_sections.create');
            Route::post('sections', [\App\Http\Controllers\Admin\PageSectionController::class, 'store'])->name('page_sections.store');
            Route::get('sections/{pageSection}', [\App\Http\Controllers\Admin\PageSectionController::class, 'show'])->name('page_sections.show');
            Route::get('sections/{pageSection}/edit', [\App\Http\Controllers\Admin\PageSectionController::class, 'edit'])->name('page_sections.edit');
            Route::put('sections/{pageSection}', [\App\Http\Controllers\Admin\PageSectionController::class, 'update'])->name('page_sections.update');
            Route::delete('sections/{pageSection}', [\App\Http\Controllers\Admin\PageSectionController::class, 'destroy'])->name('page_sections.destroy');
            Route::post('sections/order', [\App\Http\Controllers\Admin\PageSectionController::class, 'updateOrder'])->name('page_sections.order');
            Route::put('sections/{pageSection}/toggle', [\App\Http\Controllers\Admin\PageSectionController::class, 'toggleActive'])->name('page_sections.toggle');
        });
        
        // Routes pour les types de sections
        Route::resource('sections', 'App\Http\Controllers\Admin\SectionController');
        Route::put('sections/{section}/toggle', [\App\Http\Controllers\Admin\SectionController::class, 'toggleActive'])->name('sections.toggle');
        
        // Routes pour les menus
        Route::resource('menus', 'App\Http\Controllers\Admin\MenuController');
        Route::get('menus/{menu}/builder', [\App\Http\Controllers\Admin\MenuController::class, 'builder'])->name('menus.builder');
        Route::post('menus/{menu}/update-order', [\App\Http\Controllers\Admin\MenuController::class, 'updateOrder'])->name('menus.update_order');
        
        // Routes pour les éléments de menu
        Route::group(['prefix' => 'menus/{menu}'], function () {
            Route::get('items', [\App\Http\Controllers\Admin\MenuItemController::class, 'index'])->name('menu_items.index');
            Route::get('items/create', [\App\Http\Controllers\Admin\MenuItemController::class, 'create'])->name('menu_items.create');
            Route::post('items', [\App\Http\Controllers\Admin\MenuItemController::class, 'store'])->name('menu_items.store');
            Route::get('items/{menuItem}', [\App\Http\Controllers\Admin\MenuItemController::class, 'show'])->name('menu_items.show');
            Route::get('items/{menuItem}/edit', [\App\Http\Controllers\Admin\MenuItemController::class, 'edit'])->name('menu_items.edit');
            Route::put('items/{menuItem}', [\App\Http\Controllers\Admin\MenuItemController::class, 'update'])->name('menu_items.update');
            Route::delete('items/{menuItem}', [\App\Http\Controllers\Admin\MenuItemController::class, 'destroy'])->name('menu_items.destroy');
            Route::post('items/order', [\App\Http\Controllers\Admin\MenuItemController::class, 'updateOrder'])->name('menu_items.order');
            Route::put('items/{menuItem}/toggle', [\App\Http\Controllers\Admin\MenuItemController::class, 'toggleActive'])->name('menu_items.toggle');
        });

        // Routes pour les rapports
        Route::resource('reports', \App\Http\Controllers\Admin\ReportController::class)->names('reports');
        Route::get('reports/{report}/toggle-active', [\App\Http\Controllers\Admin\ReportController::class, 'toggleActive'])->name('reports.toggle-active');
        Route::post('reports/update-order', [\App\Http\Controllers\Admin\ReportController::class, 'updateOrder'])->name('reports.update-order');

        // Routes pour les sections génériques
        Route::resource('generic-sections', 'App\Http\Controllers\Admin\GenericSectionController')->names('generic_sections');
        Route::get('generic-sections/{genericSection}/toggle-active', 'App\Http\Controllers\Admin\GenericSectionController@toggleActive')->name('generic_sections.toggle-active');
        Route::post('generic-sections/update-order', 'App\Http\Controllers\Admin\GenericSectionController@updateOrder')->name('generic_sections.update-order');
    });
});

Route::view('index', 'index')->name('index');
Route::view('project_dashboard', 'project_dashboard')->name('project_dashboard');
Route::view('crypto_dashboard', 'crypto_dashboard')->name('crypto_dashboard');
Route::view('education_dashboard', 'education_dashboard')->name('education_dashboard');

Route::view('accordions', 'accordions')->name('accordions');
Route::view('add_blog', 'add_blog')->name('add_blog');
Route::view('add_product', 'add_product')->name('add_product');
Route::view('advance_table', 'advance_table')->name('advance_table');
Route::view('alert', 'alert')->name('alert');
Route::view('alignment', 'alignment')->name('alignment');
Route::view('animated_icon', 'animated_icon')->name('animated_icon');
Route::view('animation', 'animation')->name('animation');
Route::view('api', 'api')->name('api');
Route::view('area_chart', 'area_chart')->name('area_chart');
Route::view('avatar', 'avatar')->name('avatar');

Route::view('background', 'background')->name('background');
Route::view('badges', 'badges')->name('badges');
Route::view('bar_chart', 'bar_chart')->name('bar_chart');
Route::view('base_inputs', 'base_inputs')->name('base_inputs');
Route::view('basic_table', 'basic_table')->name('basic_table');
Route::view('blank', 'blank')->name('blank');
Route::view('block_ui', 'block_ui')->name('block_ui');
Route::view('blog', 'blog')->name('blog');
Route::view('blog_details', 'blog_details')->name('blog_details');
Route::view('bookmark', 'bookmark')->name('bookmark');
Route::view('bootstrap_slider', 'bootstrap_slider')->name('bootstrap_slider');
Route::view('boxplot_chart', 'boxplot_chart')->name('boxplot_chart');
Route::view('bubble_chart', 'bubble_chart')->name('bubble_chart');
Route::view('bullet', 'bullet')->name('bullet');
Route::view('buttons', 'buttons')->name('buttons');

Route::view('calendar', 'calendar')->name('calendar');
Route::view('candlestick_chart', 'candlestick_chart')->name('candlestick_chart');
Route::view('cards', 'cards')->name('cards');
Route::view('cart', 'cart')->name('cart');
Route::view('chart_js', 'chart_js')->name('chart_js');
Route::view('chat', 'chat')->name('chat');
Route::view('cheatsheet', 'cheatsheet')->name('cheatsheet');
Route::view('checkbox_radio', 'checkbox_radio')->name('checkbox_radio');
Route::view('checkout', 'checkout')->name('checkout');
Route::view('clipboard', 'clipboard')->name('clipboard');
Route::view('collapse', 'collapse')->name('collapse');
Route::view('column_chart', 'column_chart')->name('column_chart');
Route::view('coming_soon', 'coming_soon')->name('coming_soon');
Route::view('count_down', 'count_down')->name('count_down');
Route::view('count_up', 'count_up')->name('count_up');

Route::view('data_table', 'data_table')->name('data_table');
Route::view('date_picker', 'date_picker')->name('date_picker');
Route::view('default_forms', 'default_forms')->name('default_forms');
Route::view('divider', 'divider')->name('divider');
Route::view('draggable', 'draggable')->name('draggable');
Route::view('dropdown', 'dropdown')->name('dropdown');
Route::view('dual_list_boxes', 'dual_list_boxes')->name('dual_list_boxes');

Route::view('editor', 'editor')->name('editor');
Route::view('email', 'email')->name('email');
Route::view('error_400', 'error_400')->name('error_400');
Route::view('error_403', 'error_403')->name('error_403');
Route::view('error_404', 'error_404')->name('error_404');
Route::view('error_500', 'error_500')->name('error_500');
Route::view('error_503', 'error_503')->name('error_503');

Route::view('faq', 'faq')->name('faq');
Route::view('file_manager', 'file_manager')->name('file_manager');
Route::view('file_upload', 'file_upload')->name('file_upload');
Route::view('flag_icons', 'flag_icons')->name('flag_icons');
Route::view('floating_labels', 'floating_labels')->name('floating_labels');
Route::view('fontawesome', 'fontawesome')->name('fontawesome');
Route::view('footer_page', 'footer_page')->name('footer_page');
Route::view('form_validation', 'form_validation')->name('form_validation');
Route::view('form_wizard_1', 'form_wizard_1')->name('form_wizard_1');
Route::view('form_wizard_2', 'form_wizard_2')->name('form_wizard_2');
Route::view('form_wizards', 'form_wizards')->name('form_wizards');

Route::view('gallery', 'gallery')->name('gallery');
Route::view('google_map', 'google_map')->name('google_map');
Route::view('grid', 'grid')->name('grid');

Route::view('heatmap', 'heatmap')->name('heatmap');
Route::view('helper_classes', 'helper_classes')->name('helper_classes');

Route::view('iconoir_icon', 'iconoir_icon')->name('iconoir_icon');
Route::view('input_groups', 'input_groups')->name('input_groups');
Route::view('input_masks', 'input_masks')->name('input_masks');
Route::view('invoice', 'invoice')->name('invoice');

Route::view('kanban_board', 'kanban_board')->name('kanban_board');

Route::view('landing', 'landing')->name('landing');
Route::view('leaflet_map', 'leaflet_map')->name('leaflet_map');
Route::view('line_chart', 'line_chart')->name('line_chart');
Route::view('list', 'list')->name('list');
Route::view('list_table', 'list_table')->name('list_table');
Route::view('lock_screen', 'lock_screen')->name('lock_screen');
Route::view('lock_screen_1', 'lock_screen_1')->name('lock_screen_1');


Route::view('maintenance', 'maintenance')->name('maintenance');
Route::view('misc', 'misc')->name('misc');
Route::view('mixed_chart', 'mixed_chart')->name('mixed_chart');
Route::view('modals', 'modals')->name('modals');
Route::view('notifications', 'notifications')->name('notifications');

Route::view('offcanvas', 'offcanvas')->name('offcanvas');
Route::view('orders', 'orders')->name('orders');
Route::view('order_details', 'order_details')->name('order_details');
Route::view('order_list', 'order_list')->name('order_list');

Route::view('password_create_1', 'password_create_1')->name('password_create_1');
Route::view('password_reset_1', 'password_reset_1')->name('password_reset_1');
Route::view('phosphor', 'phosphor')->name('phosphor');
Route::view('pie_charts', 'pie_charts')->name('pie_charts');
Route::view('placeholder', 'placeholder')->name('placeholder');
Route::view('pricing', 'pricing')->name('pricing');
Route::view('prismjs', 'prismjs')->name('prismjs');
Route::view('privacy_policy', 'privacy_policy')->name('privacy_policy');
Route::view('product', 'product')->name('product');
Route::view('product_details', 'product_details')->name('product_details');
Route::view('product_list', 'product_list')->name('product_list');
Route::view('profile', 'profile')->name('profile');
Route::view('progress', 'progress')->name('progress');
Route::view('project_app', 'project_app')->name('project_app');
Route::view('project_details', 'project_details')->name('project_details');
Route::view('password_create', 'password_create')->name('password_create');
Route::view('password_reset', 'password_reset')->name('password_reset');

Route::view('radar_chart', 'radar_chart')->name('radar_chart');
Route::view('radial_bar_chart', 'radial_bar_chart')->name('radial_bar_chart');
Route::view('range_slider', 'range_slider')->name('range_slider');
Route::view('ratings', 'ratings')->name('ratings');
Route::view('read_email', 'read_email')->name('read_email');
Route::view('ready_to_use_form', 'ready_to_use_form')->name('ready_to_use_form');
Route::view('ready_to_use_table', 'ready_to_use_table')->name('ready_to_use_table');
Route::view('ribbons', 'ribbons')->name('ribbons');

Route::view('scatter_chart', 'scatter_chart')->name('scatter_chart');
Route::view('scrollbar', 'scrollbar')->name('scrollbar');
Route::view('scrollpy', 'scrollpy')->name('scrollpy');
Route::view('select', 'select')->name('select');
Route::view('setting', 'setting')->name('setting');
Route::view('shadow', 'shadow')->name('shadow');
Route::view('sign_in', 'sign_in')->name('sign_in');
Route::view('sign_in_1', 'sign_in_1')->name('sign_in_1');
Route::view('sign_up', 'sign_up')->name('sign_up');
Route::view('sign_up_1', 'sign_up_1')->name('sign_up_1');
Route::view('sitemap', 'sitemap')->name('sitemap');
Route::view('slick_slider', 'slick_slider')->name('slick_slider');
Route::view('spinners', 'spinners')->name('spinners');
Route::view('sweetalert', 'sweetalert')->name('sweetalert');
Route::view('switch', 'switch')->name('switch');

Route::view('tabler_icons', 'tabler_icons')->name('tabler_icons');
Route::view('tabs', 'tabs')->name('tabs');
Route::view('terms_condition', 'terms_condition')->name('terms_condition');
Route::view('textarea', 'textarea')->name('textarea');
Route::view('ticket', 'ticket')->name('ticket');
Route::view('ticket_details', 'ticket_details')->name('ticket_details');
Route::view('timeline', 'timeline')->name('timeline');
Route::view('timeline_range_charts', 'timeline_range_charts')->name('timeline_range_charts');
Route::view('to_do', 'to_do')->name('to_do');
Route::view('tooltips_popovers', 'tooltips_popovers')->name('tooltips_popovers');
Route::view('touch_spin', 'touch_spin')->name('touch_spin');
Route::view('tour', 'tour')->name('tour');
Route::view('tree-view', 'tree-view')->name('tree-view');
Route::view('treemap_chart', 'treemap_chart')->name('treemap_chart');
Route::view('two_step_verification', 'two_step_verification')->name('two_step_verification');
Route::view('two_step_verification_1', 'two_step_verification_1')->name('two_step_verification_1');
Route::view('typeahead', 'typeahead')->name('typeahead');

Route::view('vector_map', 'vector_map')->name('vector_map');
Route::view('video_embed', 'video_embed')->name('video_embed');
Route::view('weather_icon', 'weather_icon')->name('weather_icon');
Route::view('widget', 'widget')->name('widget');
Route::view('wishlist', 'wishlist')->name('wishlist');
Route::view('wrapper', 'wrapper')->name('wrapper');

// Routes pour les pages frontend
Route::get('/', [\App\Http\Controllers\Frontend\PageController::class, 'home'])->name('home');

// Route générique pour toutes les pages dynamiques
// Attention: cette route doit être placée à la fin pour éviter de capturer d'autres routes
Route::get('{slug}', [\App\Http\Controllers\Frontend\PageController::class, 'show'])->name('page.show')->where('slug', '[a-z0-9-]+');
