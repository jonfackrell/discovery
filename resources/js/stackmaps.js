
import MicroModal from 'micromodal';  // es6 module

//

window.stackmaps = {

    init:function(){
        stackmaps.loadCSS();
        stackmaps.appendMapModal();
        var items = document.getElementsByClassName(_stacks.classSelector);
        for(var i = 0; i < items.length; i++)
        {
            stackmaps.addMapLink(items[i]);
        }
    },

    addMapLink: function(item){
        var span = document.createElement('span')
        span.textContent += ' View Map'
        span.style.background = 'url(https://library.byui.edu/images/eds/map-icon.png) no-repeat';
        span.style.backgroundSize = '15px 15px';
        span.style.paddingLeft = '15px !important';
        item.appendChild(span);
        item.onclick = function(e){
            //console.log(e.target);
            stackmaps.showMapModal(e.target) // TODO: This sometimes returns the span and thus the wrong text

        }
    },

    appendMapModal: function(){
        var body = document.getElementsByTagName("BODY")[0];
        var modal = document.createElement('div');
            modal.id = 'stackmaps-modal';
            modal.classList.add('modal');
            modal.classList.add('micromodal-slide');
            modal.setAttribute('aria-hidden', 'true');
        var close = document.createElement('div');
            close.classList.add('modal__overlay');
        var dialog = document.createElement('div');
            dialog.classList.add('modal__container');
            dialog.setAttribute('role', 'dialog');
            dialog.setAttribute('aria-modal', 'true');
            dialog.setAttribute('aria-labelledby', 'modal-1-title');
        var header = document.createElement('header');
            header.classList.add('modal__header');
        var title = document.createElement('h2');
            title.innerText = "Location";
            title.classList.add('modal__title');
        var button = document.createElement('button');
            button.classList.add('modal__close');
            button.setAttribute('data-micromodal-close', String.Empty)
            button.setAttribute( 'aria-label','Close modal');
            header.appendChild(title);
            header.appendChild(button);
        var content = document.createElement('div');
            content.classList.add('modal__content');
            content.innerHTML = '<img style="" id="ltfl_smap_lbpic" src="https://pics.librarything.com/picsizes/70/47/704751f7ad41e86636f4b507577434142344148_v5.jpg">';
            dialog.appendChild(header);
            dialog.appendChild(content);
            close.appendChild(dialog)
            modal.appendChild(close)
            body.appendChild(modal);
        //MicroModal.init();
    },

    showMapModal: function(item){
        console.log('Location: ' + item.innerText);
        console.log('Call Number: ' + item.parentNode.parentNode.parentNode.getElementsByClassName('displayElementText PREFERRED_CALLNUMBER')[0].innerText);
        MicroModal.show('stackmaps-modal');
    },

    loadCSS: function(){
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = '//library.byui.edu/css/stackmaps.modal.css';
        document.getElementsByTagName('HEAD')[0].appendChild(link);
    }

};

stackmaps.init();
