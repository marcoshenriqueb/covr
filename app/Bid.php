<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bid extends Model
{
    protected $table = 'bids';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setPlaceIdAttribute($value)
    {
        $this->attributes['lat'] = $value['H'];
        $this->attributes['lng'] = $value['L'];
    }

    public function scopeSearchRadius($query, $bid, $dist, $id, $skip = 0, $take = 12)
    {
        $ln1 = $bid->lng - $dist/abs(cos(deg2rad($bid->lat))*111.2);
        $ln2 = $bid->lng + $dist/abs(cos(deg2rad($bid->lat))*111.2);
        $lt1 = $bid->lat - ($dist/111.2);
        $lt2 = $bid->lat + ($dist/111.2);
        return $query->select("id", "address", "currency", "operation", "lng", "lat", "amount", "price",
          DB::raw("3956 * 2 * ASIN(SQRT(POWER(SIN(($bid->lat - lat) * pi()/180 / 2), 2) +
          COS($bid->lat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(($bid->lng - lng) * pi()/180 / 2), 2)))
          as distance")
          )->whereBetween('lng', [$ln1, $ln2])
            ->whereBetween('lat', [$lt1, $lt2])
            ->whereNotIn('user_id', [$id])
            ->where('operation', '!=', $bid->operation)
            ->where('currency', '=', $bid->currency)
            ->orderBy('distance', 'asc')
            ->skip($skip)
            ->take($take);
    }

    public function scopeSearchTeste($query, $lat, $lng, $dist)
    {
        $ln1 = $lng - $dist/abs(cos(deg2rad($lat))*111.12);
        $ln2 = $lng + $dist/abs(cos(deg2rad($lat))*111.12);
        $lt1 = $lat - ($dist/111.12);
        $lt2 = $lat + ($dist/111.12);
        return $query->select("id", "address", "currency", "operation", "lng", "lat", "amount", "price",
          DB::raw("6378.14 * 2 * ASIN(SQRT(POWER(SIN(($lat - lat) * pi()/180 / 2), 2) +
          COS($lat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(($lng - lng) * pi()/180 / 2), 2)))
          as distance")
          )->whereBetween('lng', [$ln1, $ln2])
            ->whereBetween('lat', [$lt1, $lt2])
            ->orderBy('distance', 'asc')
            ->get();
    }
}
