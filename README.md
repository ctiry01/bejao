## About Project

Bejo for Climate Change Test

In Bejao we want to help to solve the current energy crisis and climate change problem.
So we want to develop a Vehicle sharing website to reduce the “waste” of fuel in the daily  commute to work.

The idea is a website where drivers and passengers can register to share their vehicles and reduce the waste of fuel.

Frontend Requirements:
Drivers and passengers must register to the website.
Drivers can register their vehicle:
City of origin
Destination City
Number of seat (included the drivers one)
Fuel consumption per 100Km.
passengers can register:
City of origin
Destination City
Backend Requirements:
API Service that retrieve Routes Optimization:
The API accepts origin and destination as request parameters.
It will return the best configuration of vehicles to reduce the fuel consumption.
The driver counts as a passenger.

Example:
Driver 1: 4 seats.
5 liters/per 100km.
Driver 2:
4 seats.
6 liters/per 100km.
Driver 3:
8 seats.
7 liters/per 100km.
Driver 4:
12 seats.
13 liters/per 100km.

When 6 passengers:
Car 3 is the best option.

When 4 passengers:
Car 1 is the best option.

When 12 passengers:
Car 1 + Car 3 is the best option.

Technical Requirements:
Laravel 9
Mysql
Vue or React for the frontend


## Commands

"make up-build" for build and run project inside docker container

"make dev" run factories and seeders

"make cache" clear cache of routes, conf, etc inside docker container

"make test" run integration test




