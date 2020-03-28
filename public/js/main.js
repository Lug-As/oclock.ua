$("#currencies-select").change(function () {
    curr = $(this).val();
    window.location = "currency/change?curr=" + curr;
});