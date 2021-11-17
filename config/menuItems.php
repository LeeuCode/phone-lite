<?php

return [
  'dashboard' => [
    'name' => 'الرئيسية',
    'icon' => 'fas fa-tachometer-alt',
    'route' => 'home',
    'is_single' => true,
  ],
  'items' => [
    'name' => 'الاصناف',
    'icon' => 'fas fa-database',
    'route' => 'items',
    'subitems' => [
      'all_items' => [
        'name' => 'كل الاصناف بالنظام',
        'route' => 'items'
      ],
      'create' => [
        'name' => 'انشاء صنف جديد',
        'route' => 'item.create'
      ],
      'categories' => [
        'name' => 'الأقسام',
        'route' => 'categories'
      ],
      'unities' => [
        'name' => 'الوحدات',
        'route' => 'unites'
      ],
      'models' => [
        'name' => 'الموديلات',
        'route' => 'models'
      ],

    ],
  ],
  'receipt' => [
    'name' => 'فاتورة مشتريات',
    'icon' => 'fas fa-file-invoice-dollar',
    'route' => 'invoices.purchase'
  ],

  'sale_invoice' => [
    'name' => 'فاتورة بيع',
    'icon' => 'fas fa-file-invoice',
    'route' => 'invoices.sale'
  ],
  'return_invoice' => [
    'name' => 'فاتورة مرتجع',
    'icon' => 'fas fa-file-upload',
    'route' => 'invoices.bounce'
  ],
  'maintenance' => [
    'name' => 'الصيانة',
    'icon' => 'fas fa-tools',
    'route' => 'link',
    'subitems' => [
      'all' => [
        'name' => 'كل الاجهزة المستلمه',
        'route' => 'maintenances'
      ],
      'receipt' => [
        'name' => 'استلام جهاز',
        'route' => 'maintenance.receipt'
      ],
    ]
  ],
  'phone_used' => [
    'name' => 'الاجهزة المستعمله',
    'icon' => 'fas fa-mobile-alt',
    'route' => 'link',
    'subitems' => [
      'all' => [
        'name' => 'كل الاجهزة المستعمله',
        'route' => 'devices.used'
      ],
      'create' => [
        'name' => 'شراء جهاز مستعمل',
        'route' => 'devices.used.purchase'
      ],
    ]
  ],
  // 'phone_used' => [
  //   'name' => 'الاجهزة المستعمله',
  //   'icon' => 'fas fa-mobile-alt',
  //   'route' => 'link'
  // ],
  'balance_transfer' => [
    'name' => 'تحويل رصيد',
    'icon' => 'fas fa-fax',
    'route' => 'link'
  ],
  'installments' => [
    'name' => 'الاقساط',
    'icon' => 'fas fa-money-bill-wave',
    'route' => 'link',
    'subitems' => [
      'all' => [
        'name' => 'كل الاقساط',
        'route' => 'installments'
      ],
      'create' => [
        'name' => 'إنشاء قسيمة قسط ',
        'route' => 'installments.create'
      ]
    ]
  ],
  'used' => [
    'name' => 'العملاء',
    'icon' => 'fas fa-users',
    'route' => 'users.customers'
  ],
  "suppliers" => [
    'name' => 'الموردين',
    'icon' => 'fas fa-shipping-fast',
    'route' => 'users.suppliers'
  ],
  'expenses' => [
    'name' => 'المصروفات',
    'icon' => 'fas fa-money-check-alt',
    'route' => 'link'
  ],
  'settings' => [
    'name' => 'اعدادات النظام',
    'icon' => 'fas fa-sliders-h',
    'route' => 'link'
  ],

];
