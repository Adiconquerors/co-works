<script>
        $(document).ready(function () {
            "use strict";

            @can('role_delete_multi')
                window.route_mass_crud_entries_destroy = '{{ route('roles.mass_destroy') }}';
            @endcan
            window.dtDefaultOptions.buttons = [];
        });
</script>