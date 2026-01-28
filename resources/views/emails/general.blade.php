<!DOCTYPE html>
<html>
<head>
    <title>{{ $subjectText ?? 'Email' }}</title>
</head>
<body>
<div style="font-family: Arial, sans-serif; line-height: 1.5;">
    {!! nl2br(e($bodyText)) !!}
</div>
</body>
</html>
