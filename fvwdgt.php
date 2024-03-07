<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" />
    <script type="text/javascript" src="//www.shieldui.com/shared/components/latest/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="//www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
</head>
<body class="theme-light">
<div class="outer">
    <div class="inner">
        <form onsubmit="javascript: return false;">
            <label for="widget">What is your favorite widget?</label>
            <br />
            <input id="widget" value="Chart" />
            <br />
            <br />
            <button id="submit">Submit</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    jQuery(function ($) {
        $("#widget").shieldComboBox({
            dataSource: {
                remote: {
                    read: "/api/demo-stats"
                },
                schema: {
                    data: "components"
                },
                filter: {
                    and: [
                        { path: "name", filter: "contains", value: "" }
                    ]
                }
            },
            textTemplate: "{name}",
            valueTemplate: "{name}",
            autoComplete: {
                enabled: true
            }
        });
        $("#submit").shieldButton({
            events: {
                click: function (e) {
                    alert("You typed: " + $("#widget").val());
                    e.preventDefault();
                }
            }
        });
    });
</script>
<style type="text/css">
    .outer
    {
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }
    .inner
    {
        margin: 10px;
    }
    .sui-combobox
    {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }
</style>
</body>
</html>