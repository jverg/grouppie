
<!-- Javascript libraries -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Font-awesome icons -->
<script src="https://use.fontawesome.com/567b9227ce.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
    $(document).scroll(function() {
        checkOffset();
    });

    function checkOffset() {
        // expenses sidebar
        if ($('#expenses-sidebar').offset().top + $('#expenses-sidebar').height()
                >= $('.footer').offset().top - 400)
            $('#expenses-sidebar').css('max-height', '78%');
        if ($(document).scrollTop() + window.innerHeight < $('.footer').offset().top)
            $('#expenses-sidebar').css('max-height', '100%'); // restore when you scroll up
        // incomes sidebar
        if ($('#incomes-sidebar').offset().top + $('#incomes-sidebar').height()
                >= $('.footer').offset().top - 400)
            $('#incomes-sidebar').css('max-height', '78%');
        if ($(document).scrollTop() + window.innerHeight < $('.footer').offset().top)
            $('#incomes-sidebar').css('max-height', '100%');
    }});
</script>