<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item {{ Request::is('ecommerce/admin/dashboard*') ? 'selected' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark {{ Request::is('ecommerce/admin/dashboard*') ? 'active' : '' }}"
                    href="{{ route('ecommerce.admin.dashboard') }}"
                        aria-expanded="false"><i class="mdi mdi-speedometer menu-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/orders*') ? 'selected' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark {{ Request::is('ecommerce/admin/orders*') ? 'active' : '' }}"
                        href="{{ route('ecommerce.admin.orders.index') }}" aria-expanded="false">
                        <i class="mdi mdi-sale menu-icon"></i>
                        <span class="hide-menu">Orders</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/products*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/products*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-plus-circle menu-icon"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/products*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.products.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Product</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.products.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Products</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/variants*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/variants*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="fa-solid fa-clone"></i>
                        <span class="hide-menu">Product Variants</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/variants*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.variants.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Variant</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.variants.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Variants</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/categories*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/categories*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-view-list menu-icon"></i>
                        <span class="hide-menu">Categories</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/categories*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.categories.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.categories.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Categories</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/subcategories*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/subcategories*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="fa-solid fa-droplet"></i>
                        <span class="hide-menu">Subcategories</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/subcategories*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.subcategories.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Subcategory</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.subcategories.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Subcategories</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/brands*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/brands*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="fa-solid fa-check"></i>
                        <span class="hide-menu">Brands</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/brands*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.brands.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Brand</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.brands.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Brands</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/colors*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/colors*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="fa-solid fa-copyright"></i>
                        <span class="hide-menu">Colors</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/colors*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.colors.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Color</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.colors.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Colors</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/sizes*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/sizes*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-socks"></i>
                        <span class="hide-menu">Sizes</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/sizes*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.sizes.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Size</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.sizes.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Sizes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/users*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/users*') ? 'active' : '' }}"
                    href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ Request::is('ecommerce/admin/users*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.users.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.users.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/contacts*') ? 'selected' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark {{ Request::is('ecommerce/admin/contacts*') ? 'active' : '' }}"
                        href="{{ route('ecommerce.admin.contacts.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="hide-menu">Users' Contacts</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/sliders*') ? 'selected' : '' }}">
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{ Request::is('ecommerce/admin/sliders*') ? 'active' : '' }}"
                        href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-view-carousel menu-icon"></i>
                        <span class="hide-menu">Sliders</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ Request::is('ecommerce/admin/sliders*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.sliders.create') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">Add Slider</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('ecommerce.admin.sliders.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                                <span class="hide-menu">View Sliders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('ecommerce/admin/settings*') ? 'selected' : '' }}">
                    <a class="sidebar-link waves-effect waves-dark {{ Request::is('ecommerce/admin/settings*') ? 'active' : '' }}"
                        href="{{ route('ecommerce.admin.settings.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i>
                        <span class="hide-menu">App Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
