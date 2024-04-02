<?php
namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Plugins\ACalendar;

class Calendar extends ACalendar{
    public function html():string{
      $events = [];
      foreach($this->events as $event){
        $object = new \stdClass;
        $object->title = $event->{$this->descriptionField};
        $object->start = $event->{$this->dateField};
        $object->url ="../contacts/form/".($event->{$this->id});
        $object->display='block';
        $events[] = $object;
      }
      $button = '';
      if (is_string($this->form)){
        $button = "
        headerToolbar: {
          center: 'addEventButton'
        }, 
        customButtons: {
          addEventButton: {
            text: '{$this->getLayout()->getDictionary()->get('add')}',
            click: function() {
              $('.modal-calendar').modal('show');
            }
          }
        }"  ;
      }
      $this->getLayout()->addScript("document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 600,
            locale: 'pt-br',       
            events:".json_encode($events).",".
            $button."
          });
          calendar.render();
        });
      ");
        $html =' <div class="card pd-0 bd-0 shadow-base">
          <div class="pd-x-30 pd-t-30 pd-b-15">
            <div id="calendar">
            </div>';
            if (is_string($this->form)){$this->modal();}
          $html.='</div>
        </div>';
        return $html;

    }

    public function prepare(){
      $this->getLayout()->addCss(url()->toRoute('public/common/plugins/fullcalendar-5.10.1/lib/main.css'));
      $this->getLayout()->addJs(url()->toRoute('public/common/plugins/fullcalendar-5.10.1/lib/main.js'));
      $this->getLayout()->addJs(url()->toRoute('public/common/plugins/fullcalendar-5.10.1/lib/locales/pt-br.js'));
       
    }
    private function modal(){
      $html = '<div class="modal modal-calendar " tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Adicionar </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      '.$this->form->html().'
                    </div>
                   
                  </div>
                </div>
              </div>';
      return $html;
    }
}