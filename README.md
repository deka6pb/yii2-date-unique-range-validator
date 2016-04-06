# yii2-date-unique-range-validator

Description
============
This module need to find the coordinates by address using The Google Maps Geocoding API or Yandex Geocoder API.

For example:
-----------------------------------------
```
public function rules()
{
    return [
        ...
        ['date_from', DateUniqueRangeValidator::className(), 'to' => 'date_to', 'uniqueAttributes' => ['uniqueKey']],
        ...
    ];
}
```
