{{$request = request()}}
Package: {{$request.package}}

Module: {{$request.module|string.uppercase.first}}

{{if(!is.empty($request.submodule))}}
Submodule: {{$request.submodule|string.uppercase.first}}

{{/if}}

{{binary()}} {{$request.package}} info
{{binary()}} {{$request.package}} list
{{binary()}} {{$request.package}} restart
{{binary()}} {{$request.package}} setup
