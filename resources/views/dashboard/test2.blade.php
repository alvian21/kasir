<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

</head>
<body>
<div class="container">
<div class="example">

     <select id="boot-multiselect-demo" multiple="multiple">
            <option value="jQuery">jQuery Tutorials</option>
            <option value="Bootstrap">Bootstrap Framework</option>
            <option value="HTML">HTML</option>
            <option value="CSS" >CSS</option>
            <option value="Angular">Angular</option>
            <option value="Angular">javascript</option>
            <option value="Java">Java</option>
            <option value="Python">Python</option>
            <option value="MySQL">MySQL</option>
            <option value="Oracle">Oracle</option>
    </select>

    <input type="text" name="datahitung" id="hitung">
    <button type="button" name="" id="save">save</button>
</div>


</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#boot-multiselect-demo').multiselect({
        includeSelectAllOption: true,
        buttonWidth: 250,
        enableFiltering: true
    });

    });

    $(document).ready(function(){
            $('#save').on('click', function(){
                var values = [];
                $("div input[name='datahitung']").each(function() {
                    values.push($(this).val());
                });
            });
    });
</script>
</body>
</html>

