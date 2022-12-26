<?php

namespace App\Helpers\Trim;

class TrimHelper
{
    public function trimLink(?string $description) : ?string
    {
        return isset($description) ? preg_replace('/<a href=(.*)>(.*)<\/a>/', '', $description) : $description;
    }

    public function trimEmptyArrayKey(array $requestData) : array
    {
        foreach ($requestData as $key => $value)
        {
            if (!$value)
            {
                unset($requestData[$key]);
            }
        }
        return $requestData;
    }

    public function trimHeader(string $header) : string
    {
        return preg_replace('/^(.*)\//', '', $header);
    }
}
