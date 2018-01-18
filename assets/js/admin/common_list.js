/**
 * File : common.js 
 * 
 * This file contain the validation of edit discipline form
 * 
 * @author Anil Rapani
 */

$(document).ready(function () {

            $('input[type="checkbox"].statusCheckbox').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            }).on('ifChanged', function (e) {
                var isChecked = e.currentTarget.checked;
                var id = $(this).val();
                var status;
                if (isChecked == true) {
                    status = 1;
                } else {
                    status = 2;
                }
                updateStatus(updateStatusUrl, id, status);
            });

});

function updateStatus(updateStatusUrl, id, status) {

            hitURL = baseURL + updateStatusUrl;
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: hitURL,
                data: {id: id, status: status}
            }).done(function (data) {
                if (data.status == true) {

                } else if (data.status == false) {

                } else {

                }
            });


}