<?php

return [
    'showing-all-retailers' => 'Showing All Retailers',
    'retailers-menu-alt'     => 'Show Retailers Menu',
    'create-new-retailer'    => 'Create New Retailer',
    'show-deleted-retailer' => 'Show Deleted Retailer',
    'editing-retailer'       => 'Editing Retailer :: :retailer',
    'showing-retailer'       => 'Showing Retailer :: :retailer',
    'showing-retailer-title' => ':name\'s Information',

    'createSuccess'   => 'Successfully created Retailer! ',
    'deleteSuccess'   => 'Successfully deleted Retailer! ',
    'updateSuccess' => 'Retailer updated successfully!',

    'editRetailer'               => 'Edit Retailer',
    'viewRetailer'               => 'View Retailer',
    'deleteRetailer'             => 'Delete Retailer',
    'RetailersBackBtn'           => 'Back to Retailers',
    'RetailersPanelTitle'        => 'Retailer Information',
    'RetailersDeletedPanelTitle' => 'Deleted Retailers Information',
    'RetailersBackDelBtn'        => 'Back to Deleted Retailers',

    'successRestore'     => 'Retailer Successfully Restored.',
    'successDestroy'     => 'Retailer Record successfully destroyed.',
    'errorRetailerNotFound' => 'Retailer not found.',
    'retailers-table' => [
        'caption'       => '{1} : retailerscount retailer total | [2,*]: retailerscount total retailers',
        'id'            => 'ID',
        'name'          => 'Name',
        'url'      => 'URL',
        'logo'     => 'Brand',
    ],

    'buttons' => [
        'create-new'            => 'New Retailer',
        'delete'                => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> Retailer</span>',
        'show'                  => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> Retailer</span>',
        'edit'                  => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> Retailer</span>',
        'back-to-retailers'        => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Retailer</span>',
        'back-to-retailer'         => 'Back  <span class="hidden-xs">to Retailer</span>',
        'back-to-retailers-detail' => 'Back <span class="hidden-xs"> to Retailers Detail</span>',
        'delete-retailer'          => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> Retailer</span>',
        'edit-retailer'            => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> Retailer</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New Retailer',
        'back-retailers'   => 'Back to Retailers',
        'submit-search' => 'Submit Retailers Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'show-user' => [
        'id'                => 'Retailer ID',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-users-ph'   => 'Search Users',
    ],

    'modals' => [
        'delete_retailer_message' => 'Are you sure you want to delete :retailer?',
    ],

    'validation' => [
        'nameRequired'    => 'Product Name is Required',
        'dateRequired'       => 'Date is Required',
        'imageRequired'      => 'Image URL is Required',
        'urlRequired'        => 'Retailer URL is Required',
        'retailersFileRequired' => 'Retailer File is Required',
    ],
];