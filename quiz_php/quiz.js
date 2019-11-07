$(function() {
  'use strict';

  $('.answer').on('click', function() {
    var $selected = $(this);
    var answer = $selected.text();

    $.post('/_answer.php', {
    }).done(function(res) {
      alert(res.correct_answer);
      if (answer === res.correct_answer) {
      } else {
      }
    })
  });
});