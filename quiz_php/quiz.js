$(function() {
  'use strict';

  $('.answer').on('click', function() {
    var $selected = $(this);
    if ($selected.hasClass('correct') || $selected.hasClass('wrong')) {
      return;
    }
    var answer = $selected.text();

    $.post('/_answer.php', {
    }).done(function(res) {
      $('.answer').each(function() {
        if ($(this).text() === res.correct_answer) {
          $(this).addClass('correct');
        } else {
          $(this).addClass('wrong');
        }
        $('#btn').removeClass('disabled');
       });
    })

    $('#btn').on('click', function() {
      if (!$(this).hasClass('disabled')) {
        location.reload();
      }
    })
  });
});