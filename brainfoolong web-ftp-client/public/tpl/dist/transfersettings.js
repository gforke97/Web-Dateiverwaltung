'use strict';

(function () {
  var $tpl = $('.template-settings');

  var form = {
    'mode': {
      'type': 'select',
      'label': 'transfer.mode',
      'values': {
        'never': 'transfer.mode.never',
        'replace-always': 'transfer.mode.replace-always',
        'replace-newer': 'transfer.mode.replace-newer',
        'replace-sizediff': 'transfer.mode.replace-sizediff',
        'replace-newer-or-sizediff': 'transfer.mode.replace-newer-or-sizediff',
        'rename': 'transfer.mode.rename'
      }
    },
    'max': {
      'type': 'number',
      'label': 'transfer.max',
      'description': 'transfer.max.description',
      'default': 3
    }
  };

  var loadForm = function loadForm() {
    gl.socket.send('getSettings', null, function (settings) {
      var $form = $tpl.find('.form');
      $form.html('');
      gl.form.create($form, 'settings', form, function (formData) {
        gl.socket.send('saveSettings', formData, function () {
          gl.note(gl.t('saved'), 'success');
        });
      }, function () {
        loadForm();
      }, settings);
    });
  };
  loadForm();
})();
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInRyYW5zZmVyc2V0dGluZ3MuanMiXSwibmFtZXMiOlsiJHRwbCIsIiQiLCJmb3JtIiwibG9hZEZvcm0iLCJnbCIsInNvY2tldCIsInNlbmQiLCJzZXR0aW5ncyIsIiRmb3JtIiwiZmluZCIsImh0bWwiLCJjcmVhdGUiLCJmb3JtRGF0YSIsIm5vdGUiLCJ0Il0sIm1hcHBpbmdzIjoiQUFBQTs7QUFDQSxDQUFDLFlBQVk7QUFDWCxNQUFNQSxPQUFPQyxFQUFFLG9CQUFGLENBQWI7O0FBRUEsTUFBTUMsT0FBTztBQUNYLFlBQVE7QUFDTixjQUFRLFFBREY7QUFFTixlQUFTLGVBRkg7QUFHTixnQkFBVTtBQUNSLGlCQUFTLHFCQUREO0FBRVIsMEJBQWtCLDhCQUZWO0FBR1IseUJBQWlCLDZCQUhUO0FBSVIsNEJBQW9CLGdDQUpaO0FBS1IscUNBQTZCLHlDQUxyQjtBQU1SLGtCQUFVO0FBTkY7QUFISixLQURHO0FBYVgsV0FBTztBQUNMLGNBQVEsUUFESDtBQUVMLGVBQVMsY0FGSjtBQUdMLHFCQUFlLDBCQUhWO0FBSUwsaUJBQVk7QUFKUDtBQWJJLEdBQWI7O0FBcUJBLE1BQU1DLFdBQVcsU0FBWEEsUUFBVyxHQUFZO0FBQzNCQyxPQUFHQyxNQUFILENBQVVDLElBQVYsQ0FBZSxhQUFmLEVBQThCLElBQTlCLEVBQW9DLFVBQVVDLFFBQVYsRUFBb0I7QUFDdEQsVUFBTUMsUUFBUVIsS0FBS1MsSUFBTCxDQUFVLE9BQVYsQ0FBZDtBQUNBRCxZQUFNRSxJQUFOLENBQVcsRUFBWDtBQUNBTixTQUFHRixJQUFILENBQVFTLE1BQVIsQ0FBZUgsS0FBZixFQUFzQixVQUF0QixFQUFrQ04sSUFBbEMsRUFBd0MsVUFBVVUsUUFBVixFQUFvQjtBQUMxRFIsV0FBR0MsTUFBSCxDQUFVQyxJQUFWLENBQWUsY0FBZixFQUErQk0sUUFBL0IsRUFBeUMsWUFBWTtBQUNuRFIsYUFBR1MsSUFBSCxDQUFRVCxHQUFHVSxDQUFILENBQUssT0FBTCxDQUFSLEVBQXVCLFNBQXZCO0FBQ0QsU0FGRDtBQUdELE9BSkQsRUFJRyxZQUFZO0FBQ2JYO0FBQ0QsT0FORCxFQU1HSSxRQU5IO0FBT0QsS0FWRDtBQVdELEdBWkQ7QUFhQUo7QUFDRCxDQXRDRCIsImZpbGUiOiJ0cmFuc2ZlcnNldHRpbmdzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiJ3VzZSBzdHJpY3QnO1xuKGZ1bmN0aW9uICgpIHtcbiAgY29uc3QgJHRwbCA9ICQoJy50ZW1wbGF0ZS1zZXR0aW5ncycpXG5cbiAgY29uc3QgZm9ybSA9IHtcbiAgICAnbW9kZSc6IHtcbiAgICAgICd0eXBlJzogJ3NlbGVjdCcsXG4gICAgICAnbGFiZWwnOiAndHJhbnNmZXIubW9kZScsXG4gICAgICAndmFsdWVzJzoge1xuICAgICAgICAnbmV2ZXInOiAndHJhbnNmZXIubW9kZS5uZXZlcicsXG4gICAgICAgICdyZXBsYWNlLWFsd2F5cyc6ICd0cmFuc2Zlci5tb2RlLnJlcGxhY2UtYWx3YXlzJyxcbiAgICAgICAgJ3JlcGxhY2UtbmV3ZXInOiAndHJhbnNmZXIubW9kZS5yZXBsYWNlLW5ld2VyJyxcbiAgICAgICAgJ3JlcGxhY2Utc2l6ZWRpZmYnOiAndHJhbnNmZXIubW9kZS5yZXBsYWNlLXNpemVkaWZmJyxcbiAgICAgICAgJ3JlcGxhY2UtbmV3ZXItb3Itc2l6ZWRpZmYnOiAndHJhbnNmZXIubW9kZS5yZXBsYWNlLW5ld2VyLW9yLXNpemVkaWZmJyxcbiAgICAgICAgJ3JlbmFtZSc6ICd0cmFuc2Zlci5tb2RlLnJlbmFtZSdcbiAgICAgIH1cbiAgICB9LFxuICAgICdtYXgnOiB7XG4gICAgICAndHlwZSc6ICdudW1iZXInLFxuICAgICAgJ2xhYmVsJzogJ3RyYW5zZmVyLm1heCcsXG4gICAgICAnZGVzY3JpcHRpb24nOiAndHJhbnNmZXIubWF4LmRlc2NyaXB0aW9uJyxcbiAgICAgICdkZWZhdWx0JyA6IDNcbiAgICB9XG4gIH1cblxuICBjb25zdCBsb2FkRm9ybSA9IGZ1bmN0aW9uICgpIHtcbiAgICBnbC5zb2NrZXQuc2VuZCgnZ2V0U2V0dGluZ3MnLCBudWxsLCBmdW5jdGlvbiAoc2V0dGluZ3MpIHtcbiAgICAgIGNvbnN0ICRmb3JtID0gJHRwbC5maW5kKCcuZm9ybScpXG4gICAgICAkZm9ybS5odG1sKCcnKVxuICAgICAgZ2wuZm9ybS5jcmVhdGUoJGZvcm0sICdzZXR0aW5ncycsIGZvcm0sIGZ1bmN0aW9uIChmb3JtRGF0YSkge1xuICAgICAgICBnbC5zb2NrZXQuc2VuZCgnc2F2ZVNldHRpbmdzJywgZm9ybURhdGEsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBnbC5ub3RlKGdsLnQoJ3NhdmVkJyksICdzdWNjZXNzJylcbiAgICAgICAgfSlcbiAgICAgIH0sIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgbG9hZEZvcm0oKVxuICAgICAgfSwgc2V0dGluZ3MpXG4gICAgfSlcbiAgfVxuICBsb2FkRm9ybSgpXG59KSgpXG4iXX0=