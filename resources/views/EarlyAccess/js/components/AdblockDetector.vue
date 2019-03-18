<template>
<div class="modal fade" id="adblockModal" tabindex="-1" role="dialog" aria-labelledby="adblockModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adblockModalTitle">Adblock Detected</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <blockquote class="blockquote">
            <p class="mb-0">
                Let's get real here about ads. Ads are a nuisance to everyone, I get it, but the reality is that the servers running this website have costs and although I'm doing what I can to monetize in other ways (subscriptions for example) I have to wait for approval from Hi-Rez lawyers. Ads are the only source of income that are paying the bills, which I'm currently paying out of pocket. There's not a lot of them [ads], only a couple on each page (however that is automated by Google Adsense). If you truly feel like you have to continue blocking ads, click the "I know what I'm doing" button and we won't bother you again during this session.
            </p>

            <footer class="blockquote-footer">Matthew "Zencep" Hatcher <cite title="Owner, Paladins Ninja">Owner, Paladins Ninja</cite></footer>
        </blockquote>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Let me think</button>
        <button type="button" class="btn btn-danger" @click="acknowledge">I know what I'm doing</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    import VueAdBlockDetect from 'vue-adblock-detect';

    export default{
        mixins: [VueAdBlockDetect],


        beforeMount(){
            this.detectAdBlock().then((response)=>{
                if(response) {
                    if (localStorage.acknowledgeAdblock == undefined) {
                        $('#adblockModal').modal('show');
                    }
                }
            });
        },

        methods: {
            acknowledge() {
                localStorage.acknowledgeAdblock = true;
                $('#adblockModal').modal('hide');
            }
        }
    }
</script>
