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

    public function scopeSearchRadius($query, $dist, $id, $skip = 0, $take = 12)
    {
        $ln1 = $this->lng - $dist/abs(cos(deg2rad($this->lat))*111.2);
        $ln2 = $this->lng + $dist/abs(cos(deg2rad($this->lat))*111.2);
        $lt1 = $this->lat - ($dist/111.2);
        $lt2 = $this->lat + ($dist/111.2);
        return $query->join('users', 'users.id', '=', 'bids.user_id')
          ->select("bids.id", "bids.address", "bids.currency", "bids.operation", "bids.lng", "bids.lat", "bids.amount", "bids.price", "users.nome", "users.sobrenome", "users.profile_pic",
            DB::raw("3956 * 2 * ASIN(SQRT(POWER(SIN(($this->lat - bids.lat) * pi()/180 / 2), 2) +
            COS($this->lat * pi()/180) * COS(bids.lat * pi()/180) * POWER(SIN(($this->lng - bids.lng) * pi()/180 / 2), 2)))
            as distance")
            )->whereBetween('bids.lng', [$ln1, $ln2])
              ->whereBetween('bids.lat', [$lt1, $lt2])
              ->whereNotIn('bids.user_id', [$id])
              ->where('bids.operation', '!=', $this->operation)
              ->where('bids.currency', '=', $this->currency)
              ->orderBy('distance', 'asc');
    }

    public function scopeSearchFriendsRadius($query, $dist, $user, $skip = 0, $take = 12)
    {
        $ln1 = $this->lng - $dist/abs(cos(deg2rad($this->lat))*111.2);
        $ln2 = $this->lng + $dist/abs(cos(deg2rad($this->lat))*111.2);
        $lt1 = $this->lat - ($dist/111.2);
        $lt2 = $this->lat + ($dist/111.2);
        return $query->join('users', 'users.id', '=', 'bids.user_id')
          ->select("bids.id", "bids.address", "bids.currency", "bids.operation", "bids.lng", "bids.lat", "bids.amount", "bids.price", "users.nome", "users.sobrenome", "users.profile_pic",
            DB::raw("3956 * 2 * ASIN(SQRT(POWER(SIN(($this->lat - lat) * pi()/180 / 2), 2) +
            COS($this->lat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(($this->lng - lng) * pi()/180 / 2), 2)))
            as distance")
            )->whereBetween('lng', [$ln1, $ln2])
              ->whereBetween('lat', [$lt1, $lt2])
              ->whereNotIn('user_id', [$user->id])
              ->whereIn('user_id', $user->friends->modelKeys())
              ->where('operation', '!=', $this->operation)
              ->where('currency', '=', $this->currency)
              ->orderBy('distance', 'asc');
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
