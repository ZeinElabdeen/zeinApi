var DatatablesBasicPaginations = {
    init: function () {
        $("#m_table_1").DataTable({
            responsive: !0,
            pagingType: "full_numbers",
            processing: true,
            serverSide: false,
            order: [[ 0, "desc" ]],
            language : {
                "search": "بحث ",
                sZeroRecords : 'لا يوجد نتائج',
                sInfoFiltered:"(فلتر من _MAX_ عنصر)",
                "processing": "جاري التحميل ..",
                "lengthMenu":     "عرض _MENU_",
                "info":           "عرض _START_ الى _END_ من _TOTAL_",
                "infoEmpty":      "عرض 0 الى 0 من 0",
                "paginate": {
                        "next": "التالي",
                        "previous":"رجوع"
                    }
            },
        })
    }
};
jQuery(document).ready(function () {
    DatatablesBasicPaginations.init()
});