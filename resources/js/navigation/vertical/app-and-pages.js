export default [
    { heading: "Apps & Pages" },
    {
        title: "Question",
        icon: { icon: "tabler-file" },
        children: [
            { title: "List", to: "admin-question-list" },
            // {
            //     title: "Preview",
            //     to: {
            //         name: "admin-question-edit-id",
            //         params: { id: "5036" },
            //     },
            // },
            // {
            //     title: "Edit",
            //     to: { name: "admin-question-edit-id", params: { id: "5036" } },
            // },
            { title: "Add", to: "admin-question-add" },
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
