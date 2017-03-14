[![Build Status](https://travis-ci.org/rafaelqueiroz/parking.svg?branch=master)](https://travis-ci.org/rafaelqueiroz/parking)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rafaelqueiroz/parking/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rafaelqueiroz/parking/?branch=master)

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

### Problem

I own a parking lot that can hold up to 'n' cars at any given point in time. Each slot is given a number starting at 1 increasing with increasing distance from the entry point in steps of one. I want to create an automated ticketing system that allows my customers to use my parking lot without human intervention.

When a car enters my parking lot, I want to have a ticket issued to the driver. The ticket issuing process includes us documenting the registration number (number plate) and the colour of the car and allocating an available parking slot to the car before actually handing over a ticket to the driver (we assume that our customers are nice enough to always park in the slots allocated to them). The customer should be allocated a parking slot which is nearest to the entry. At the exit the customer returns the ticket which then marks the slot they were using as being available.

The system should provide me with the ability to find out:

- Registration numbers of all cars of a particular colour.
- Slot number in which a car with a given registration number is parked.
- Slot numbers of all slots where a car of a particular colour is parked.

We interact with the system via a simple set of commands which produce a specific output. The system should allow input in two ways:

- It should provide us with an interactive command prompt based shell where commands can be typed in 
- It should accept a filename as a parameter at the command prompt and read the commands from that file 

### Requiremnts

You have to solve the problem without any external libraries except for a testing lib for TDD. 

Your solution must build+run on Linux. 

### License

The Parking Sample is available under an MIT License.
