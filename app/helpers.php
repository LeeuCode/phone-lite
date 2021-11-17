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
    return '';
  }
}
