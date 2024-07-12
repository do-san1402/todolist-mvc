<?php

use App\App\App; ?>
<script type="text/javascript" src="<?php echo App::get('config')['APP_URL'] . '/public/assets/js/jquery.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo App::get('config')['APP_URL'] . '/public/assets/js/jquery.validate.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo App::get('config')['APP_URL'] . '/public/assets/js/moment.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo App::get('config')['APP_URL'] . '/public/assets/js/daterangepicker.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo App::get('config')['APP_URL'] . '/public/assets/js/fullcalendar.min.js' ?>"></script>

<script>
    $(document).ready(function() {
        $('form').validate()

        var startDate = $('#starting_date')
        var endDate = $('#ending_date')
        if (typeof startDate !== 'undefined' && typeof endDate !== 'undefined') {

            var opt = {
                singleDatePicker: true,
                minYear: 2020,
                startDate: moment(),
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss',
                }
            }

            startDate.daterangepicker(opt, function(start, end, label) {
                var s = start.format('YYYY-MM-DD HH:mm:ss')

                opt.minDate = s
                endDate.daterangepicker(opt)
            })

            opt.minDate = startDate.val()
            endDate.daterangepicker(opt, function(start, end, label) {
            })
        }

        //handle view
        $('.view-state').on('click', function(e) {
            e.preventDefault()

            var type = $(this).data('type')

            $('.box-view').hide()
            $('.box-' + type).show()
        })

        //remove alert
        setTimeout(function() {
            if (typeof $('.alert') !== 'undefined') {
                $('.alert').remove()
            }
        }, 3000)

        //confirm delete work
        $('.delete-work').on('click', function(e) {
            e.preventDefault()

            var href = $(this).attr('href')

            if (confirm('Are you sure to delete?') == true) {
                window.location.href = href
            }
        })
    })
</script>

<?php if (isset($calendarItems)) : ?>
    <script>
        $(document).ready(function() {
            //calendar view
            var events = <?php echo json_encode($calendarItems); ?>

            if (typeof $('#calendar') !== 'undefined') {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listWeek'
                    },
                    defaultDate: "<?php echo date('Y-m-d') ?>",
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: events
                })
            }
        })
    </script>
<?php endif; ?>
</body>

</html>