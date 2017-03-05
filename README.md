### Parking
Parking Sample with PHP.

### Usage

The application is available via command line. Just run commands:

###### create_parking_project <number_of_slots>

```php parking create_parking_lot 6```

###### park <plate> <colour>

```php parking park KA-01-HH-1234 White```

###### leave <slot_number>

```php parking leave 4```

###### registration_numbers_for_cars_with_colour <colour>

```php parking registration_numbers_for_cars_with_colour White```

###### slot_numbers_for_cars_with_colour <colour>

```php parking slot_numbers_for_cars_with_colour White```

###### slot_number_for_registration_number <plate>

```php parking slot_number_for_registration_number KA-01-HH-3141```

###### import <file>

```php parking import /parking/tmp/import```

### Sample

![alt tag](https://github.com/rafaelqueiroz/parking/blob/master/sample_import.png)

### License

The Parking Sample is available under an MIT License.
