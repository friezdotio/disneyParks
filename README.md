# disneyparks

Unofficial Disney Park Wait-time API written on top of the WaffleFry PHP framework.

## Installation

There are only 2 steps.

- Upload to your web host.
- Update `define('URL_SUB_FOLDER', 'disneyparks');` in config.php if you change the subfolder name, or comment that line out if it's in the root.
- (Optional) Disable the Dashboard on Production.

## Usage

Usage is very simple. Each API access point has it's own dashboard where you can test and play around with it.

## Resorts

### index.php/resorts/get

Returns all of the Disney Resorts and their information.

Output Example:

```
[
	{
		"id": "80007798",
		"name": "Walt Disney World",
		"location": "Orlando, FL",
		"region": "us"
	},
	{
		"id": "80008297",
		"name": "Disneyland Resort",
		"location": "Anaheim, CA",
		"region": "us"
	},
	...
]

```

Dashboard: index.php/resorts

### index.php/resort/get/{resortid}

Returns a single entry of the Disney Resorts and their information.

Parameters:

- resortid (required): The ID of the resort you want returned.

Output Example:

```
	{
		"id": "80007798",
		"name": "Walt Disney World",
		"location": "Orlando, FL",
		"region": "us"
	}

```

Dashboard: index.php/resort

## Parks

### index.php/parks/get/{resortid}/{region}

Returns all of the parks under a specific resort.

Parameters:

- resortid (required): The ID of the resort the parks are associated with.
- region (optional): The region of the resort the parks are assiciated with. (Defaults to US. International resorts are required to have the region.)

Output Example:

```
	[
        {
            "id": "80007944;entityType=theme-park",
            "name": "Magic Kingdom Park",
            "location": {
                "North East Bounds": {
                    "gps": {
                        "latitude": "28.42206389",
                        "longitude": "-81.57639718"
                    }
                },
                "South West Bounds": {
                    "gps": {
                        "latitude": "28.41459052",
                        "longitude": "-81.58654683"
                    }
                },
                "Guest Entrance": {
                    "gps": {
                        "latitude": "28.4160036778",
                        "longitude": "-81.5811902834"
                    },
                    "xyMaps": {
                        "x": "536",
                        "y": "404"
                    }
                }
            }
        },
        ...
    ]

```

Dashboard: index.php/parks

### index.php/park/get/{parkid}/{region}

Returns the details of a park specific to it's ID.

Parameters:

- parkid (required): The ID of the park you want returned.
- region (optional): The region of the resort the parks are assiciated with. (Defaults to US. International resorts are required to have the region.)

Output Example:

```
	{
        "id": "80007944;entityType=theme-park",
        "name": "Magic Kingdom Park",
        "location": {
            "North East Bounds": {
                "gps": {
                    "latitude": "28.42206389",
                    "longitude": "-81.57639718"
                }
            },
            "South West Bounds": {
                "gps": {
                    "latitude": "28.41459052",
                    "longitude": "-81.58654683"
                }
            },
            "Guest Entrance": {
                "gps": {
                    "latitude": "28.4160036778",
                    "longitude": "-81.5811902834"
                },
                "xyMaps": {
                    "x": "536",
                    "y": "404"
                }
            }
        },
        "schedules": [
            {
                "date": "2017-03-10",
                "startTime": "08:00:00",
                "endTime": "09:00:00",
                "type": "Extra Magic Hours",
                "timeZone": "EST"
            },
            {
                "date": "2017-03-10",
                "startTime": "09:00:00",
                "endTime": "22:00:00",
                "type": "Operating",
                "timeZone": "EST"
            },
            {
                "date": "2017-03-11",
                "startTime": "08:00:00",
                "endTime": "00:00:00",
                "type": "Operating",
                "timeZone": "EST"
            },
            ...
        ]
    }

```

Dashboard: index.php/park

## Attractions

### index.php/attractions/get/{parkid}/{region}

Returns all of the parks under a specific resort.

Parameters:

- parkid (required): The ID of the park the attractions are associated with.
- region (optional): The region of the resort the parks are assiciated with. (Defaults to US. International resorts are required to have the region.)

Output Example:

```
	[
        {
            "id": "5490;entityType=Attraction",
            "name": "Stitch's Great Escape!",
            "type": "Attraction",
            "waitTime": {
                "fastPass": {
                    "available": false
                },
                "status": "Closed",
                "singleRider": false,
                "rollUpStatus": "Closed",
                "rollUpWaitTimeMessage": "Closed"
            }
        },
        {
            "id": "136550;entityType=Attraction",
            "name": "Monsters, Inc. Laugh Floor",
            "type": "Attraction",
            "waitTime": {
                "fastPass": {
                    "startTime": "FASTPASS is Not Available",
                    "available": true
                },
                "status": "Operating",
                "singleRider": false,
                "postedWaitMinutes": 10,
                "rollUpStatus": "Operating",
                "rollUpWaitTimeMessage": "Short Wait Times"
            }
        },
        ...
    ]

```

Dashboard: index.php/attractions

### index.php/attraction/get/{attractionid}/{type}/{region}

Returns the details of an attraction specific to it's ID.

Parameters:

- attractionid (required): The ID of the attraction you want returned.
- type (required): The type of attraction it is. It will either be `attractions` for an Attraction or `entertainments` for Entertainment.
- region (optional): The region of the resort the parks are assiciated with. (Defaults to US. International resorts are required to have the region.)

Output Example:

```
	{
        "id": "136550;entityType=Attraction",
        "name": "Monsters, Inc. Laugh Floor",
        "type": "Attraction",
        "location": {
            "Guest Entrance": {
                "gps": {
                    "latitude": "28.4183977566",
                    "longitude": "-81.5797358751"
                },
                "xyMaps": {
                    "x": "708",
                    "y": "447"
                }
            }
        },
        "waitTime": {
            "fastPass": {
                "startTime": "FASTPASS is Not Available",
                "available": true
            },
            "status": "Operating",
            "singleRider": false,
            "postedWaitMinutes": 10,
            "rollUpStatus": "Operating",
            "rollUpWaitTimeMessage": "Short Wait Times"
        },
        "schedules": ""
    }

```

Dashboard: index.php/park

## WaffleFry Framework

disneyparks is currently built on our WaffleFry framework, which is still in BETA. There are a few known issues that are very minor that is metioned below.

- All arguments on the dashboard is (optional). Please ignore this and use this README.md as a reference to what is really optional.
- disneyparks/index.php will error out.

[WaffleFry Framework](https://github.com/friezdotio/WaffleFry)