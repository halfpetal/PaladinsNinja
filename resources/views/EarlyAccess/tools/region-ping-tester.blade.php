@extends('layouts.app')

@section('content')
<div class="container">
    @php
        function pingDomain($domain, $port){
            $starttime = microtime(true);
            $file      = fsockopen ($domain, $port, $errno, $errstr, 10);
            $stoptime  = microtime(true);
            $status    = 0;

            if (!$file) $status = -1;  // Site is down
            else {
                fclose($file);
                $status = ($stoptime - $starttime) * 1000;
                $status = floor($status);
            }
            return $status;
        }

        dd(pingDomain('172.98.76.52', 9003))
    @endphp
</div>
@endsection