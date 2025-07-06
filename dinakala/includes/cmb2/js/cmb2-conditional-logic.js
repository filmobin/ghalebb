jQuery(document).ready(function($) {
  function toggleConditionalFields() {
      $('[data-conditional-id]').each(function() {
          var $conditionalField = $(this);
          var targetFieldId = $conditionalField.data('conditional-id');
          var expectedValue = $conditionalField.data('conditional-value');
          var $targetField = $('#' + targetFieldId);

          var actualValue;

          if ($targetField.is(':checkbox')) {
              actualValue = $targetField.is(':checked') ? 'on' : 'off';
          } else if ($targetField.is(':radio')) {
              actualValue = $('input[name="' + $targetField.attr('name') + '"]:checked').val();
          } else {
              actualValue = $targetField.val();
          }

          if (actualValue === expectedValue) {
              $conditionalField.closest('.cmb-row').show();
          } else {
              $conditionalField.closest('.cmb-row').hide();
          }
      });
  }

  toggleConditionalFields();

  $('[data-conditional-id]').each(function() {
      var targetFieldId = $(this).data('conditional-id');
      $('#' + targetFieldId).on('change', function() {
          toggleConditionalFields();
      });

      if ($('#' + targetFieldId).is(':radio')) {
          $('input[name="' + $('#' + targetFieldId).attr('name') + '"]').on('change', function() {
              toggleConditionalFields();
          });
      }
  });
});
