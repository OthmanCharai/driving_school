export default [
    { heading: "Apps & Pages" },
    {
        title: "Invoice",
        icon: { icon: "tabler-file" },
        children: [
            { title: "List", to: "admin-invoice-list" },
            // {
            //     title: "Preview",
            //     to: {
            //         name: "admin-invoice-edit-id",
            //         params: { id: "5036" },
            //     },
            // },
            // {
            //     title: "Edit",
            //     to: { name: "admin-invoice-edit-id", params: { id: "5036" } },
            // },
            { title: "Add", to: "admin-invoice-add" },
        ],
    },
    {
        title: "User",
        icon: { icon: "tabler-user" },
        children: [
            { title: "List", to: "admin-user-list" },
            {
                title: "View",
                to: { name: "admin-user-view-id", params: { id: 21 } },
            },
        ],
    },
];
