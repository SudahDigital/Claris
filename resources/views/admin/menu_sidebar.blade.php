		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <li class="nav-header" style="font-size: 20px;"><strong> Home</strong></li>
			  <li class="nav-item has-treeview">
			    <a href="{{URL::route('dashboard')}}" class="nav-link">
			      <i class="nav-icon fas fa-tachometer-alt"></i>
			      <p>Dashboard</p>
			    </a>
			  </li>
		      <li class="nav-item has-treeview">
			    <a href="{{URL::route('dash_banner')}}" class="nav-link">
			       	<i class="fas fa-image nav-icon"></i>
			        <p>Manage Banner</p>
			    </a>
			  </li>
			  <li class="nav-item has-treeview">
			    <a href="{{URL::route('dash_produk')}}" class="nav-link">
			        <i class="fas fa-lightbulb nav-icon"></i>
			        <p>Manage Product</p>
			    </a>
			  </li>
			  <li class="nav-item has-treeview">
			    <a href="{{URL::route('dash_kategori')}}" class="nav-link">
			        <i class="fas fa-clipboard-list nav-icon"></i>
			        <p>Manage Category</p>
			    </a>
			  </li>
			  <li class="nav-item has-treeview">
			    <a href="{{URL::route('dash_kontak')}}" class="nav-link">
			        <i class="fas fa-phone nav-icon"></i>
			        <p>Manage Contact</p>
			    </a>
			  </li>
			  <li class="nav-item has-treeview">
		        <a href="#" class="nav-link">
		          <i class="nav-icon fas fa-shopping-bag"></i>
		          <p>
		            Manage Order
		            <i class="right fas fa-angle-left"></i>
		          </p>
		        </a>
		        <ul class="nav nav-treeview">
		          <li class="nav-item">
		            <a href="{{URL::route('list_order')}}" class="nav-link">
		              <i class="fas fa-angle-right nav-icon"></i>
		              <p>List Order</p>
		            </a>
		          </li>
		        </ul>
		      </li>
		      <li class="nav-item has-treeview">
			    <a href="{{URL::route('dash_voucher')}}" class="nav-link">
			        <i class="fas fa-tags nav-icon"></i>
			        <p>Manage Voucher</p>
			    </a>
			  </li>
		      @if(auth()->user()->role == 'superadmin')
				  <li class="nav-item has-treeview">
				    <a href="{{URL::route('dash_user')}}" class="nav-link">
				        <i class="fas fa-user nav-icon"></i>
				        <p>Manage User Admin</p>
				    </a>
				  </li>
			  @endif

			  <!-- <li class="nav-header">PREFERENCES</li>
			  <li class="nav-item has-treeview">
			    <a href="{{URL::route('logout')}}" class="nav-link">
			        <i class="nav-icon fas fa-power-off"></i>
			        <p>Log-Out</p>
			    </a>
			  </li> -->
			</ul>
		</nav>
	</div>
</aside>