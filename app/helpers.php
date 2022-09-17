<?php

function maintenanceStatus($key = null)
{
    $values = [
        '1' => __('جاري العمل عليها'),
        '2' => __('تم الحل'),
        '3' => __('لم يتم حل المشكله')
    ];

    if (is_null($key)) {
        return $values;
    } else {
        return $values[$key];
    }
}

function movementType($key = null)
{
    $values = [
        'cash' => __('نقدي'),
        'dues' => __('آجال'),
    ];

    if (is_null($key)) {
        return $values;
    } else {
        return $values[$key];
    }
}

function invoiceType($key = null)
{
    $values = [
        'sale' => __('بيع'),
        'purchase' => __('شراء'),
        'bounce' => __('مرتجع'),
        'bounce_dameg' => __('مرتجع تالف'),
    ];

    // if (is_null($key)) {
    //     return $values;
    // } else {
    //     return $values[$key];
    // }

    return (is_null($key)) ? $values : $values[$key];
}

function getVal($invoice, $selector)
{
    if (is_object($invoice)) {
        return $invoice->$selector;
    } else {
        return 0;
    }
}

function permissions()
{
    return [
        'items' => [
            'name' => __('الاصناف'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'categories' => [
            'name' => __('الاقسام'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'unities' => [
            'name' => __('الوحدات'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'models' => [
            'name' => __('الموديلات'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'receipt' => [
            'name' => __('فاتورة مشتريات'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'sale_invoice' => [
            'name' => __('فاتورة بيع'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'return_invoice' => [
            'name' => __('فاتورة مرتجع'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'maintenance' => [
            'name' => __('الصيانة'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'installments' => [
            'name' => __('الاقساط'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',

            ]
        ],
        'used' => [
            'name' => __('العملاء'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'suppliers' => [
            'name' => __('الموردين'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'users' => [
            'name' => __('المستخدمين'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'permissions' => [
            'name' => __('صلاحية المستخدمين'),
            'roles' => [
                '' => 'إظهار الكل',
                '_create' => 'إنشاء',
                '_edit' => 'تعديل',
                '_delete' => 'حذف',
            ]
        ],
        'reporting' => [
            'name' => __('التقارير'),
            'roles' => [
                '' => 'إظهار الكل',
                '_daily' => 'التقرير اليومي',
                '_inventory' => 'جرد الاصناف',
                '_sale' => 'حركة المبياعات',
            ]
        ],
    ];
}

function addOption($key, $value)
{
    if (!empty($value)) {
        $val = '';

        if (is_array($value)) {
            $val = json_encode($value);
        } else {
            $val = $value;
        }

        $lang = app()->getLocale();

        $optionFound =  \DB::table('options')->where('key', $key)->count();

        if ($optionFound > 0) {
            \DB::table('options')->where('key', $key)
                ->update(['value' => $val]);
        } else {
            \DB::table('options')->insertGetId([
                'key'       => $key,
                'value'     => $val,
                'lang'      => $lang
            ]);
        }
    }
    return false;
}

function getOption($key)
{
    $optionDefualt = \DB::table('options')->where('key', $key);

    $option = \DB::table('options')->where('key', $key);

    if ($option->count() > 0) {
        $val = $option->first()->value;

        if (json_decode($val)) {
            return json_decode($val);
        }

        return $val;
    }
    // elseif ($optionDefualt->count() > 0) {
    //     $val = $optionDefualt->first()->value;
    //
    //     if (json_decode($val)) {
    //         return json_decode($val);
    //     }
    //
    //     return $val;
    // }

    return '';
}

function getPermission($packageID, $key)
{
    $permission = DB::table('permissions')
        ->where('group_permission_id', $packageID)
        ->where('key', $key)
        ->count();

    if ($permission > 0) {
        return true;
    } else {
        return false;
    }
}


function sidbarItems()
{
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
                'balance' => [
                    'name' => 'رصيد اول المده',
                    'route' => 'item.balance'
                ],
            ]
        ],
        'categories' => [
            'name' => 'الأقسام',
            'icon' => 'fa fa-cubes',
            'route' => 'categories'
        ],
        'unities' => [
            'name' => 'الوحدات',
            'icon' => 'fa fa-puzzle-piece',
            'route' => 'unities'
        ],
        'models' => [
            'name' => 'الموديلات',
            'icon' => 'fa fa-cube',
            'route' => 'models'
        ],
        'receipt' => [
            'name' => 'فواتير المشتريات',
            'icon' => 'fas fa-file-invoice-dollar',
            'route' => 'link',
            'subitems' => [
                'receipt' => [
                    'name' => 'كل فواتير الشراء',
                    'route' => "invoices.purchases"
                ],
                'create' => [
                    'name' => 'فاتورة مشتريات جديده',
                    'route' => 'invoices.purchase'
                ],
            ]
        ],
        'sale_invoice' => [
            'name' => 'فاتورة بيع',
            'icon' => 'fas fa-file-invoice',
            'route' => 'link',
            'subitems' => [
                'sale_invoice' => [
                    'name' => 'كل فواتير البيع',
                    'route' => 'invoices.sales'
                ],
                'create' => [
                    'name' => 'فاتورة البيع جديده',
                    'route' => 'invoices.sale'
                ],
            ]
        ],
        'return_invoice' => [
            'name' => 'فاتورة مرتجع',
            'icon' => 'fas fa-file-upload',
            'route' => '',
            'subitems' => [
                'return_invoice' => [
                    'name' => 'كل فواتير البيع',
                    'route' => 'invoices.sales'
                ],
                'create' => [
                    'name' => 'فاتورة البيع جديده',
                    'route' => 'invoices.bounce'
                ],
            ]
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
}
