<?php

return [
    'showing-all-offers'  => 'Showing All Offers',
    'offers-menu-alt'     => 'Show Offers Menu',
    'create-new-offer'    => 'Create New Offer',
    'upload-offers'       => 'Upload Offers',
    'show-deleted-offers' => 'Show Deleted Offers',
    'editing-offer'       => 'Editing Offer :: :product',
    'showing-offer'       => 'Showing offer :: :product',
    'showing-offer-title' => ':name\'s Information',

    //Flash Message
    'createSuccess'   => 'Successfully created Offer! ',
    'importSuccess'   => 'Successfully Imported Offer! ',
    'deleteSuccess'   => 'Successfully deleted Offer! ',
    'uploadSuccess'   => 'Successfully uploaded Today\'s Offers',

    'editOffer'               => 'Edit Offer',
    'viewOffer'               => 'View Offer',
    'deleteOffer'             => 'Delete Offer',
    'offersBackBtn'           => 'Back to Offers',
    'offersPanelTitle'        => 'Offer Information',
    'offersDeletedPanelTitle' => 'Deleted Offers Information',
    'offersBackDelBtn'        => 'Back to Deleted Offers',

    'successRestore'     => 'Offer Successfully Restored.',
    'successDestroy'     => 'Offer Record successfully destroyed.',
    'errorOfferNotFound' => 'Offer not found.',

    'offers-table' => [
        'caption'       => '{1} : offerscount offer total | [2,*]: offerscount total offers',
        'id'            => 'ID',
        'date'          => 'Date',
        'retailer'      => 'Retailer',
        'nosOffers'     => 'No. of Offers',
        'created'       => 'Created',
        'updated'       => 'Updated',
        'actions'       => 'Actions',
        'updated'       => 'Updated',
        'available'     => 'Available',
        'department'    => 'Department',
        'dateCode'      => 'Date Code',
        'product'       => 'Product',
        'currentPrice'  => 'Current Price ( $ )',
        'discountOffer' => 'Discount Offer',
        'imageUrl'      => 'Image Link',
        'category'      => 'Category',
        'offerUrl'      => 'Offer Link'
    ],

    'buttons' => [
        'create-new'            => 'New Offer',
        'upload-offers'         => 'Upload Offers',
        'delete'                => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> Offer</span>',
        'show'                  => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> Offer</span>',
        'edit'                  => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> Offer</span>',
        'back-to-offers'        => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Offer</span>',
        'back-to-offer'         => 'Back  <span class="hidden-xs">to Offer</span>',
        'back-to-offers-detail' => 'Back <span class="hidden-xs"> to Offers Detail</span>',
        'delete-offer'          => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> Offer</span>',
        'edit-offer'            => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> Offer</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New Offer',
        'back-offers'   => 'Back to Offers',
        'submit-search' => 'Submit Offers Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'show-user' => [
        'id'                => 'Offer ID',
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
        'delete_offer_message' => 'Are you sure you want to delete :offer?',
    ],

    'validation' => [
        'productRequired'    => 'Product Name is Required',
        'dateRequired'       => 'Date is Required',
        'retailerRequired'   => 'Select Retailer',
        'priceRequired'      => 'Price is Required and should be between 0 to 9999.99',
        'discountRequired'   => 'Discount is Required and should be between 0 to 99.99',
        'imageRequired'      => 'Image URL is Required',
        'urlRequired'        => 'Offer URL is Required',
        'offersFileRequired' => 'Offer File is Required',
    ],
];