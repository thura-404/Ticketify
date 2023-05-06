<!DOCTYPE html>
<html>
<head>
    <title>Chosen Select Demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
</head>
<body>
    <select class="chosen-select" data-live-search="true">
        <option value=""></option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>

    <select class="chosen-select" data-live-search="true">
        <option value=""></option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>
    <select class="chosen-select" data-live-search="true">
        <option value=""></option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>

    <select class="chosen-select" data-live-search="true">
        <option value=""></option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log("Chosen plugin initialized");
            $('.chosen-select').chosen();
        });
    </script>
</body>
</html>
