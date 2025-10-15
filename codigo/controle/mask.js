$(document).ready(function(){
  $('#telefone').mask('(99) 9 9999-9999');
});


$(document).ready(function(){
  var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(99) 9 9999-9999' : '(99) 9 9999-9999';
  },
  spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };
  
  $('#telefone').mask(SPMaskBehavior, spOptions);
});

