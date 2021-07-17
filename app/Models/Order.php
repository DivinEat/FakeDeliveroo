<?php


namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $collection = 'deliveroo_orders';
    protected $primaryKey = 'order_id';
}
