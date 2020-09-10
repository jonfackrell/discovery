<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-886315-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-886315-1');
</script>
<script type='text/javascript'>
    window.__lo_site_id = 115865;

    (function() {
        var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
        wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
    })();
</script>
<script>
    window.onUsersnapCXLoad = function(api) {
        api.init({
            user: {
                user_id: "{{ optional(auth()->user())->id }}", // Id of the user
                email: "{{ optional(auth()->user())->email }}" // Email address
            }
        });
    }
    var script = document.createElement('script');
    script.defer = 1;
    script.src = 'https://widget.usersnap.com/global/load/f0632680-0847-4e59-a7b5-88a1f9adf57d?onload=onUsersnapCXLoad';
    document.getElementsByTagName('head')[0].appendChild(script);
</script>
