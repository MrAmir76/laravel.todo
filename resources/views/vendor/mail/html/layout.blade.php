<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fa">
<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
</head>
<body>
<table class="content" style="width:100vw">
    {{ $header  }}
    <tr>
        <td class="body" width="100vw" style="border: hidden !important;width:100vw">
            <table class="inner-body" align="center" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell">
                        {{$slot}}
                        {{ $subcopy  }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
