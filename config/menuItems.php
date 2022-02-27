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
      'items' => [
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
        'route' => 'unities'
      ],
      'models' => [
        'name' => 'الموديلات',
        'route' => 'models'
      ],
      'balance' => [
        'name' => 'رصيد اول المده',
        'route' => 'item.balance'
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
  'expenses' => [
    'name' => 'الحسابات',
    'icon' => 'fas fa-cash-register',
    'route' => 'link'
  ],
  'users' => [
    'name' => 'المستخدمون',
    'icon' => 'fas fa-user-tie',
    'route' => 'link',
    'subitems' => [
      'all' => [
        'name' => 'المستخدمين',
        'route' => 'users.employees'
      ],
      'add_user' => [
        'name' => 'أضف مستخدم جديد',
        'route' => 'users.employee.create'
      ],
      'permissions' => [
        'name' => 'صلاحية المستخدمين',
        'route' => 'permissions',
      ],
    ]
  ],
  'reporting' => [
    'name' => 'التقارير',
    'icon' => 'fas fa-chart-bar',
    'route' => 'link',
    'subitems' => [
      'daily' => [
        'name' => 'التقرير اليومي',
        'route' => 'reports.daily'
      ],
      'items' => [
        'name' => 'جرد الاصناف',
        'route' => 'reports.items.inventory'
      ],
      'sale_invoice' => [
        'name' => 'حركة المبيعات',
        'route' => 'reports.invoice.sale'
      ],
    ]
  ],
  'settings' => [
    'name' => 'اعدادات النظام',
    'icon' => 'fas fa-sliders-h',
    'route' => 'settings.index'
  ],

];
