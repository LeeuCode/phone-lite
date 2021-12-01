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
    ],
    'categories' => [
      'name' => __('الاقسام'),
    ],
    'unities' => [
      'name' => __('الوحدات'),
    ],
    'models' => [
      'name' => __('الموديلات'),
    ],
    'receipt' => [
      'name' => __('فاتورة مشتريات'),
    ],
    'sale_invoice' => [
      'name' => __('فاتورة بيع'),
    ],
    'return_invoice' => [
      'name' => __('فاتورة مرتجع'),
    ],
    'maintenance' => [
      'name' => __('الصيانة'),
    ],
    'installments' => [
      'name' => __('الاقساط'),
    ],
    'used' => [
      'name' => __('العملاء'),
    ],
    'suppliers' => [
      'name' => __('الموردين'),
    ],
    'users' => [
      'name' => __('المستخدمين'),
    ],
    'permissions' => [
      'name' => __('صلاحية المستخدمين'),
    ],
    'reporting' => [
      'name' => __('التقارير'),
    ],
  ];
}
