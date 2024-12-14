# OpenWeather API Setup Guide

This guide will show us how to register, setup until use in current project.

## Step 1: Register for OpenWeather API

1. **Create an Account**:  
   Go to the [OpenWeather website](https://openweathermap.org/) and sign up for a new account.

2. **Verify Your Email**:  
   Check your email inbox for the verification email from OpenWeather and follow the instructions to verify your account.

3. **Generate API Key**:  
   After logging in, go to the [API section](https://openweathermap.org/api), and generate your API key.  
   Copy the API key, as you'll need it to make requests to the API. 
   **Disclimer, in here some APIs can use for free but each has limits**

## Step 2: Choose the API You Will Use

1. **Current Weather Data**:  
   For current weather data, we use the [Current Weather API](https://openweathermap.org/current).  
   This API provides current weather details for any location based on latitude and longitude.

2. **API Parameters**:  
   The `Current Weather API` requires the following parameters:
   - `lat`: Latitude of the location.
   - `lon`: Longitude of the location.
   - `appid`: Your OpenWeather API key.
   
## Step 3: Implement in Project

I created 3 files to structure the implementation:

1. **Config File**:  
   This file is used to load specific credentials, making it easier to update them in the future.

2. **API Config File**:  
   This file handles communication with the external API to retrieve weather data.

3. **OpenWeather API File**:  
   This file is responsible for manipulating the data returned from the API. Specifically, it handles the logic for storing or updating data into a JSON file.  
   In this case, I chose to use a JSON file because it is only necessary to store a single set of data at a time, which makes reading and writing the data faster and simpler. Since only one data set is being stored, this approach is efficient for my needs.
   
##### Usage of OpenWeather API File:

	This file can be used in the job file when you want to fetch data every hour and can also be used when displaying the current weather. This is because the file contains functions to either get data from the JSON file or store data into the JSON file. By centralizing this logic in one file, it becomes easier to develop features.

**Note**:  
	In this approach, there is a scenario in the test that needs to be discussed. For example, the use of cache fetching every 15 minutes. In my understanding, this can be eliminated because there is already an automatic data fetch scenario every hour via the job scheduler. The intention behind this is to avoid hitting the API repeatedly, but even if we use file cache or Redis, we are still hitting our own API. On the other hand, we cannot hit the external API due to the automatic scheduler running every hour. Therefore, there shouldn't be any need to fetch from the cache during this time. It should be enough to simply get the data from the JSON file.
