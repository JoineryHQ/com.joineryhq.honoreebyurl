CRM.$(function($) {
  var scMessage = CRM.vars.honoreebyurl.scMessage;
  if (scMessage) {
    // If a Soft Credit message is defined, inject it into the form near the top.
    $('div#intro_text, div.amount_display-group').before('<div id="honoreebyurl-softcredit-message" class="messages status">' + scMessage + '</div>');
  }
});
