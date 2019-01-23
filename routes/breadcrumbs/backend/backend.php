<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->push('Category', route('admin.category.index'));
});

Breadcrumbs::for('admin.make.index', function ($trail) {
    $trail->push('Make', route('admin.make.index'));
});

Breadcrumbs::for('admin.listing.index', function ($trail) {
    $trail->push('Listing', route('admin.listing.index'));
});

Breadcrumbs::for('admin.listing.create', function ($trail) {
    $trail->push('Add Listing', route('admin.listing.create'));
});
Breadcrumbs::for('admin.listing.show', function ($trail, $listing) {
    $trail->push('Edit Listing', route('admin.listing.show', $listing->id));
});
// SHow single Make [make]
Breadcrumbs::for('admin.make.show', function ($trail, $make) {
	$trail->parent('admin.make.index');
    $trail->push($make->name, route('admin.make.show', $make->id));
});

// News Breadcrumb
Breadcrumbs::for('admin.news.index', function ($trail) {
    $trail->push('ALl News', route('admin.news.index'));
});
Breadcrumbs::for('admin.news.show', function ($trail, $news) {
	$trail->parent('admin.news.index');
    $trail->push($news->title, route('admin.news.show', $news->id));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
