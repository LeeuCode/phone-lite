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
  ];

  if (is_null($key)) {
    return $values;
  } else {
    return $values[$key];
  }
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
    if(!empty($value)) {
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
