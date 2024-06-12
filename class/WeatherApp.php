<?php

class WeatherApp {

    private $apiUrl;
    public function __construct($apiUrl) {
        $this->apiUrl = $apiUrl;
    }

    public function fetchWeather() {
        $weatherData = $this->fetchData();
        if ($weatherData) {
            return $this->parseWeatherData($weatherData);
        } else {
            return false;
        }
    }

    private function fetchData() {
        $jsonData = file_get_contents($this->apiUrl);
        if ($jsonData) {
            return json_decode($jsonData, true);
        } else {
            return false;
        }
    }

    private function formatTimestamp($timestamp) {
        if (!$timestamp) {
            return false;
        }
        return date('l, d F Y H:i:s', $timestamp);
    }

    private function parseWeatherData($weatherData) {
        $weatherInfo = [];
        $weatherInfo['coord'] = [
            'lon' => $weatherData['coord']['lon'],
            'lat' => $weatherData['coord']['lat']
        ];

        $weatherInfo['weather'] = [
            'main' => $weatherData['weather'][0]['main'],
            'description' => $weatherData['weather'][0]['description'],
            'icon' => $this->getWeatherIcon($weatherData['weather'][0]['main'])
        ];

        $weatherInfo['temp'] = $weatherData['main']['temp'];
        $weatherInfo['feels_like'] = $weatherData['main']['feels_like'];

        $weatherInfo['sys'] = [
            'sunrise'   => $this->formatTimestamp($weatherData['sys']['sunrise']),
            'sunset'    => $this->formatTimestamp($weatherData['sys']['sunset'])
        ];

        return $weatherInfo;
    }

    private function getWeatherIcon($weatherMain) {
        if (!$weatherMain) {
            return false;
        }
        $icons = [
            'Clear'         => 'img/sky-clear.png',
            'Clouds'        => 'img/clouds.png',
            'Rain'          => 'img/rain.png',
            'Thunderstorm'  => 'img/thunderstorm.png',
        ];
        $defaultIcon = 'clear.svg';
        return isset($icons[$weatherMain]) ? $icons[$weatherMain] : $defaultIcon;
    }
}
?>