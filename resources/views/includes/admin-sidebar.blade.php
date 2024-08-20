<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{URL::to('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('fund-collection')}}" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Product Sale</span>
            </a>
          </li> -->



          <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('partners')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-source-branch menu-icon"></i>
              <span class="menu-title">Partners</span>
            </a>
          </li>


       
      <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('company-type')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-source-branch menu-icon"></i>
              <span class="menu-title">Company Type</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('store')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-account-check menu-icon"></i>
              <span class="menu-title">Company</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('country')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-account-check menu-icon"></i>
              <span class="menu-title">Country</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('province')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-account-check menu-icon"></i>
              <span class="menu-title">Province</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('bank-transfer')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-account-check menu-icon"></i>
              <span class="menu-title">Bank Transfer</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#collection_report" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Monthly Report</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="collection_report">
              <ul class="nav flex-column sub-menu">

              <li class="nav-item"> <a class="nav-link" href="{{URL::to('monthly-share-report-store-wise')}}">Income Statement</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('monthly-share-report-partner-wise')}}">Partner Statement</a></li>
              </ul>
            </div>
     
          </li>
          
         
        </ul>
      </nav>