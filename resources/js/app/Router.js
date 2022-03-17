import React from "react";
import styled from "styled-components";
import { Routes, Route, Link } from "react-router-dom";
import {Login} from "./pages/Login";
import {Register} from "./pages/Register";
import {Home} from "./pages/Home";


export const Router = () => {
    return (
        <Routes>
            <Route path="/" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/home" element={<Home />} />
        </Routes>
    )
}

