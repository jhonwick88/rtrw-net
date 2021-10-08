<template>
  <div class="row justify-content-center my-5">
    <div class="col-md-12">
      <div class="card shadow bg-light">
        <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
          <div class="mx-3 my-3 text-center">
            <div>
                <img alt="Logo" :src="setting.site_logo" width="55" height="55">
               <h1 class="m-2">{{ setting.site_1 }}<span>{{ setting.site_2 }}</span></h1>
            </div>

            <h3 class="h3 my-4">
              Welcome to your {{ setting.site_1 }}{{ setting.site_2 }} application!
            </h3>

            <div class="text-muted">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas corrupti in ullam ab distinctio nemo libero neque consequuntur aut voluptatibus, dolores corporis quis eaque, ex maiores dignissimos et sit facilis.
            </div>
          </div>
        </div>
        <div class="row g-0">
          <div class="col-md-6 pr-0">
            <div class="card-body border-right border-bottom p-3 h-100">
              <div class="d-flex flex-row bd-highlight mb-3">
                <div :style="`font-size: 34px;color: #${(Math.random()*0xFFFFFF<<0).toString(16)}`">
                  <i class='bx bxl-bitcoin bx-tada bx-rotate-90' ></i>
                </div>
                <div class="pl-3">
                  <div class="mb-2">
                    <a href="/admin/coins" class="h5 font-weight-bolder text-decoration-none text-dark">Coins</a>
                  </div>
                  <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas corrupti in ullam ab distinctio nemo libero neque consequuntur aut voluptatibus, dolores corporis quis eaque, ex maiores dignissimos et sit facilis.
                  </p>
                  <a href="/admin/coins" class="text-decoration-none">
                    <div class="mt-3 d-flex align-content-center font-weight-bold text-primary">
                      <div>Explore the coins</div>

                      <div class="ml-1 text-primary">
                        <svg viewBox="0 0 20 20" fill="currentColor" width="16" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 pl-0">
            <div class="card-body border-bottom p-3 h-100">
              <div class="d-flex flex-row bd-highlight mb-3">
                <div :style="`font-size: 34px;color: #${(Math.random()*0xFFFFFF<<0).toString(16)}`">
                  <i class='bx bx-show bx-fade-up bx-flip-horizontal' ></i>
                </div>
                <div class="pl-3">
                  <div class="mb-2">
                    <a href="/admin/watchlist" class="h5 font-weight-bolder text-decoration-none text-dark">Watchlits</a>
                  </div>
                  <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas corrupti in ullam ab distinctio nemo libero neque consequuntur aut voluptatibus, dolores corporis quis eaque, ex maiores dignissimos et sit facilis.
                  </p>
                  <a href="/admin/watchlist" class="text-decoration-none">
                    <div class="mt-3 d-flex align-content-center font-weight-bold text-primary">
                      <div>Start to Watchlits</div>

                      <div class="ml-1 text-primary">
                        <svg viewBox="0 0 20 20" fill="currentColor" width="16" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 pr-0">
            <div class="card-body border-right p-3 h-100">
              <div class="d-flex flex-row bd-highlight mb-3">
                <div :style="`font-size: 34px;color: #${(Math.random()*0xFFFFFF<<0).toString(16)}`">
                  <i class='bx bxs-user-circle bx-fade-down bx-flip-horizontal' ></i>
                </div>
                <div class="pl-3">
                  <div class="mb-2">
                    <a href="/admin/users" class="h5 font-weight-bolder text-decoration-none text-dark">Users</a>
                  </div>
                  <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas corrupti in ullam ab distinctio nemo libero neque consequuntur aut voluptatibus, dolores corporis quis eaque, ex maiores dignissimos et sit facilis.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 pl-0">
            <div class="card-body p-3 h-100">
              <div class="d-flex flex-row bd-highlight mb-3">
                <div :style="`font-size: 34px;color: #${(Math.random()*0xFFFFFF<<0).toString(16)}`">
                  <i class='bx bxs-wrench bx-burst' ></i>
                </div>
                <div class="pl-3">
                  <div class="mb-2">
                    <a href="/admin/settings" class="h5 font-weight-bolder text-decoration-none text-dark">Settings</a>
                  </div>
                  <p class="text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas corrupti in ullam ab distinctio nemo libero neque consequuntur aut voluptatibus, dolores corporis quis eaque, ex maiores dignissimos et sit facilis.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

export default {
        props:{
      setting: Object,
   },
  components: {
    JetApplicationLogo,
  },
}
</script>
