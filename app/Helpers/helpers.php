<?php

    if (!function_exists('hasValue')) {
        /**
         * Check If Value Exists
         *
         * @param $value
         * @return bool
         */
        function hasValue($value)
        {
            return !!$value;
        }

    }


    if (!function_exists('formatDates')) {

        function formatDates($dates)
        {
            $formattedDates = [];

            foreach ($dates as $date) {
                $formattedDates[] = \Carbon\Carbon::parse($date)->format('Y-m-d');
            }

            return $formattedDates;
        }

    }
