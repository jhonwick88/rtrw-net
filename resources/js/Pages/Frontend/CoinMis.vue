<template>
   
                    <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-6">
                     <div class="card text-white text-center p-5 bg-card">
                     <h3 class="text-white">Your Favorite Coin Missing?</h3>
                     <p>Can't find your coin? List your favorite coin now!</p>
                     <p>Get your community to vote for your coin and gain exposure.</p>
                     <a href="/submit/coin" class="btn btn-round btn-primary" >Submit Coin</a>                    
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="card text-white text-center p-5 bg-card">
                    <h3 class="text-white">View New Listings?</h3>
                    <p>Click the button below to view the New Listings!</p>
                    <p>These coins were just submitted.</p>
                    <a href="/coin/filter/new" class="btn btn-round btn-primary" >View New Listings</a>                    
                    </div>
                 </div>
               </div>
               <!-- seo content -->
               <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 p-3 text-center text-white">
            <h3 class="text-white">Find the best new cryptocurrency projects</h3>
            <p>
                Did ever you wonder where people find the best new cryptocurrency projects, coins and tokens like Doge and Shiba Inu? They use
                websites like <a :href="$page.props.setting_new.site_url">{{$page.props.setting_new.site_name}}</a>. Cryptocurrency projects are listed here before CoinMarketCap,
                CoinGecko and major exchanges. Find the best crypto moonshots on our website.
            </p>
            <p>
                However: before investing always do your
                own research (DYOR)! Listing on <a href="/">{{$page.props.setting_new.site_name}}</a> does NOT mean we endorse the project, they could be scams.
                Be careful with your investments.
            </p>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 p-3 text-center text-white">

            <h3 class="text-white">How does CoinSniper work?</h3>
            <p>
                New cryptocurrency projects can be listed <a href="/submit/coin">Applying Here.</a> Once applied, they instantly become visible
                on the <a href="/coin/filter/new">New Listings Page.</a> New listings require 500 votes to be officially listed in our top list.
                After that, anyone can see and vote for the project.
            </p>
            <p>
                Get your community to vote on your project, because votes matter! Our ranking is simple: the highest votes is #1 on our website.
                The project will get exposure with all our visitors!
            </p>
            <p>
                <b>Note on voting:</b> Unique votes only count once for the "All Time" page, but can count every 24 hours on the "Today" page.
            </p>
        </div>
    </div>
               <!-- end seo content -->
            </div>
   
</template>
<script>
export default {
    setup() {
        
    },
}
</script>
<style scoped>
.bg-card{
   background-color: #111621;
}
</style>