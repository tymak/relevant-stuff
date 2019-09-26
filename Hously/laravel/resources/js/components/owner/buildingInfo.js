import React from "react";
const BuildingInfo = ({ data, owners, users, flats, residents }) => {
    return (
        <>
            <div className="page__main__dash__item i__full">
                <div className="page__main__dash__item__head">
                    <h3>Tato budova</h3>
                </div>
                <div className="page__main__dash__item__body">
                    <table>
                        <thead>
                            <tr>
                                <th colSpan="2">Building information </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>City</td>
                                <td>{data.city}</td>
                            </tr>
                            <tr>
                                <td>Street</td>
                                <td>{data.street}</td>
                            </tr>
                            <tr>
                                <td>House number</td>
                                <td>{data.house_number}</td>
                            </tr>
                            <tr>
                                <td>Number of floors</td>
                                <td>
                                    {` above ground: ` +
                                        `${data.floors_above_ground}` +
                                        ` underground: ` +
                                        `${data.floors_bellow_ground}`}
                                </td>
                            </tr>
                            <tr>
                                <td>Heating</td>
                                <td>{data.heating ? "ano" : "ne"}</td>
                            </tr>
                            <tr>
                                <td>Elevator</td>
                                <td>{data.elevator} (krát)</td>
                            </tr>

                            <tr>
                                <td>Owner</td>
                                <td>
                                    {`${
                                        users[owners[0].user_id - 1].first_name
                                    }` +
                                        ` ` +
                                        `${
                                            users[owners[0].user_id - 1]
                                                .last_name
                                        }`}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <th colSpan="3">Flats</th>
                        </thead>

                        <tbody>
                            {flats.map(flat => {
                                if (flat.residential) {
                                    return (
                                        <>
                                            <tr>
                                                <td>Floor: {flat.floor}</td>
                                                <td>
                                                    Flat number: {flat.number}
                                                </td>
                                                <td>
                                                    Flat user:
                                                    {residents.map(resident => {
                                                        if (
                                                            resident.flat_id ==
                                                            flat.id
                                                        ) {
                                                            return (
                                                                <>
                                                                    {`${
                                                                        users[
                                                                            resident.user_id -
                                                                                1
                                                                        ]
                                                                            .first_name
                                                                    }` +
                                                                        ` ` +
                                                                        `${
                                                                            users[
                                                                                resident.user_id -
                                                                                    1
                                                                            ]
                                                                                .last_name
                                                                        }`}
                                                                </>
                                                            );
                                                        }
                                                    })}
                                                </td>
                                            </tr>
                                        </>
                                    );
                                }
                            })}
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <th colSpan="3">non-residential units</th>
                        </thead>

                        <tbody>
                            {flats.map(flat => {
                                if (!flat.residential) {
                                    return (
                                        <>
                                            <tr>
                                                <td>Floor: {flat.floor}</td>
                                                <td>
                                                    Unit number: {flat.number}
                                                </td>
                                                <td>
                                                    User:
                                                    {residents.map(resident => {
                                                        if (
                                                            resident.flat_id ==
                                                            flat.id
                                                        ) {
                                                            return (
                                                                <>
                                                                    {`${
                                                                        users[
                                                                            resident.user_id -
                                                                                1
                                                                        ]
                                                                            .first_name
                                                                    }` +
                                                                        ` ` +
                                                                        `${
                                                                            users[
                                                                                resident.user_id -
                                                                                    1
                                                                            ]
                                                                                .last_name
                                                                        }`}
                                                                </>
                                                            );
                                                        }
                                                    })}
                                                </td>
                                            </tr>
                                        </>
                                    );
                                }
                            })}
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    );
};

export default BuildingInfo;
